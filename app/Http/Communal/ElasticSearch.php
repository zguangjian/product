<?php

/**
 * Created by PhpStorm.
 * User: zguangjian
 * CreateDate: 2021/1/6 14:31
 * Email: zguangjian@outlook.com
 */

namespace App\Http\Communal;


use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

trait  ElasticSearch
{
    /**
     * ES客户端
     * @var Client
     */
    public $EsClient;

    /**
     * 数据库
     * @var
     */
    public $index;

    /**
     * 表
     * @var
     */
    public $type;

    /**
     * ElasticSearch constructor.
     */
    public function __construct()
    {
        /** 设置数据库  */
        $this->index = env('DB_DATABASE');
        /** 设置表  */
        $this->type = $this->getTable();
        /** 实例化ES客户端  */
        $this->EsClient = ClientBuilder::create()->setHosts(["localhost:9200"])->build();
    }


    public function search($query = [], $from = 0, $size = 5)
    {
        $params = [
            'index' => $this->index,
            // 'index' => 'm*', #index 和 type 是可以模糊匹配的，甚至这两个参数都是可选的
            'type' => $this->type,
            '_source' => ['first_name', 'age'], // 请求指定的字段
            'body' => array_merge([
                'from' => $from,
                'size' => $size
            ], $query)
        ];
        return $this->EsClient->search($params);
    }

    public function getDocs($id)
    {
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'body' => [
                'id' => $id
            ]
        ];
        return $this->EsClient->mget($params);
    }

    /**
     * 获取 ES 的状态信息，包括index 列表
     * @return array
     */
    public function status()
    {
        return $this->EsClient->indices()->stats();
    }

    /**
     * @param array $body
     * @return array
     */
    public function addDoc($body = [])
    {
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'body' => $body
        ];

        return $this->EsClient->index($params);
    }

    /**
     * @param $id
     * @param array $body
     * @return array
     */
    public function editDoc($id, $body = [])
    {
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id,
            'body' => [
                'doc' => $body
            ]
        ];
        return $this->EsClient->update($params);
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteDoc($id)
    {
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id,
        ];
        return $this->EsClient->delete($params);
    }


    /**
     * 检查Index 是否存在
     * @return bool
     */
    public function checkIndexExists()
    {
        $params = [
            'index' => $this->index
        ];
        return $this->EsClient->indices()->exists($params);
    }


    /**
     * 创建一个索引 Index （非关系型数据库里面那个索引，而是关系型数据里面的数据库的意思）
     * @return void
     */
    public function createIndex()
    {
        $params = [
            'index' => $this->index,
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];
        $this->EsClient->indices()->create($params);
    }

    /**
     * 删除一个Index
     * @return void
     */
    public function deleteIndex()
    {
        $params = [
            'index' => $this->index
        ];
        if ($this->checkIndexExists()) {
            $this->EsClient->indices()->delete($params);
        }
    }


}
