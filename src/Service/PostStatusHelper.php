<?php

namespace App\Service;

use App\Entity\Post;

class PostStatusHelper
{
    public static function statusList()
    {
        return [
            Post::POST_ACTIVE => 'Active',
            Post::POST_NO_ACTIVE => 'No active',
            Post::POST_DRAFT => 'Draft',
        ];
    }

    public static function statusListDropDown()
    {
        return [
            'Active' => Post::POST_ACTIVE,
            'No active' => Post::POST_NO_ACTIVE,
            'Draft' => Post::POST_DRAFT
        ];
    }

    public static function statusName($status)
    {
        foreach (self::statusList() as $key => $statusOfArr){
            if ($key == $status){
                return $statusOfArr;
            }
        }
        return Post::POST_NOT_FOUND_STATUS;
    }

    public static function statusLabel($status)
    {
        switch ($status) {
            case Post::POST_ACTIVE:
                $class = 'badge badge-success';
                break;
            case Post::POST_DRAFT:
                $class = 'badge badge-dark';
                break;
            case Post::POST_NO_ACTIVE:
                $class = 'badge badge-danger';
                break;
            default:
                $class = 'badge badge-primary';
        }

        return '<span class="' . $class . '">' . self::statusName($status) . '</span>';
    }
}