<?php


    namespace App\Classes;


    class NestingDepthCounter
    {
        //adds new attribute "nestingDepth" with current nesting depth to each post
        //todo: add parameter/functionality for name of child relationship
        static function addNestingDepths($models)
        {
            static $nestingDepth = -1;
            $nestingDepth++;
            foreach ($models as $model) {
                $model->setAttribute('nestingDepth', $nestingDepth);
                if ($model->allChildren_withUser->isNotEmpty()) {
                    $model->allChildren_withUser = NestingDepthCounter::addNestingDepths($model->allChildren_withUser);
                }
            }
            $nestingDepth--;
            return $models;
        }
    }
