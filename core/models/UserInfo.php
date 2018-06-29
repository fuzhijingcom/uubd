<?php
/**
 * @link http://www.simpleforum.org/
 * @copyright Copyright (c) 2015 Simple Forum
 * @author Jiandong Yu admin@simpleforum.org
 */

namespace app\models;

class UserInfo extends \yii\db\ActiveRecord
{
    const SCENARIO_EDIT = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_info}}';
    }

    public function scenarios()
    {
        return [self::SCENARIO_EDIT => ['website', 'about','location','tagline','email_close','topic_close','comment_close','mynodes','top_close','css_close','mycss','qq']];
    }

    public function rules()
    {
        return [
			[['website', 'about','location','tagline','email_close','topic_close','comment_close','mynodes','top_close','css_close','mycss','qq'], 'trim'],
            ['website', 'url', 'defaultScheme' => 'http'],
            ['website', 'string', 'max' => 100],
            ['location', 'string', 'max' => 100],
            ['tagline', 'string', 'max' => 100],
            ['topic_close', 'string', 'max' => 1],
            ['comment_close', 'string', 'max' => 1],
            ['mynodes', 'string', 'max' => 1],
            ['email_close', 'string', 'max' => 1],
            ['top_close', 'string', 'max' => 1],
            ['about', 'string', 'max' => 255],
            ['qq', 'string', 'max' => 15],
            ['css_close', 'string', 'max' => 1],
            ['mycss', 'string', 'max' => 10000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'website' => '个人网站',
            'about' => '个人简介',
            'company' => '所在公司',
            'company_title' => '工作职位',
            'location' => '所在地',
            'tagline' => '签名',
            'qq' => 'QQ',
            'email_close' => '我的邮箱',
            'topic_close' => '我的主题',
            'comment_close' => '我的回复',
            'mynodes' => '在首页显示收藏节点',
            'top_close' => '社区排行榜',
            'css_close' => '使用自定义CSS',
            'mycss' => ' ',
        ];
    }

	public static function updateCounterInfo($action, $user_id)
	{
		$upd = [
			'addTopic' => ['topic_count'=>1],
			'deleteTopic' => ['topic_count'=>-1],
			'addComment' => ['comment_count'=>1],
			'deleteComment' => ['comment_count'=>-1],
			'followNode' => ['favorite_node_count'=>1],
			'unfollowNode' => ['favorite_node_count'=>-1],
			'followTopic' => ['favorite_topic_count'=>1],
			'unfollowTopic' => ['favorite_topic_count'=>-1],
			'followUser' => ['favorite_user_count'=>1],
			'unfollowUser' => ['favorite_user_count'=>-1],
                                        'followVote_topic' => ['favorite_vote_count'=>1],
                                        'unfollowVote_topic' => ['favorite_vote_count'=>-1],
                                        'followVote_comment' => ['favorite_vote_count'=>1],
                                        'unfollowVote_comment' => ['favorite_vote_count'=>-1],
			'followed' => ['favorite_count'=>1],
			'unfollowed' => ['favorite_count'=>-1],
                                        'day' => ['day'=>1],
                                        'night' => ['night'=>0],

		];

		if( !isset($upd[$action]) ) {
			return false;
		}
		return static::updateAllCounters($upd[$action], ['user_id'=>$user_id]);
	}

}
