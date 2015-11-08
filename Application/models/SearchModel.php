<?php

namespace application\models;

use application\additionally\Connection;

class SearchModel
{
    public $string;
    public $searchResultArray;
    private $searchArray;
    private $stringArray;
    private $regExpArray;

    public function getSearch()
    {
        $this->setRegExpArray();
        $this->getSearchList();
        return $this->searchResultArray;
    }

    private function setRegExpArray(){
        if(!empty($this->string)){
            $this->separateSearchRequest();
            $this->cleaningString();
            $this->regExpArray[] = $this->getFirstRegExp();
            $this->regExpArray[] = $this->getSecondRegExp();
            $this->regExpArray[] = $this->getThirdRegExp();
            $this->regExpArray[] = $this->getFourthRegExp();
        }
    }


    private function separateSearchRequest()
    {
        $this->stringArray = preg_split('/[+ -!@#$%ˆ*()\[\]]/', $this->string, -1, PREG_SPLIT_NO_EMPTY);//делим строку
    }

    private function cleaningString()
    {
        $this->searchArray = array();
        foreach($this->stringArray as $value){
            $value = strip_tags($value);
            $this->searchArray[] =  preg_replace( '/(ый||ий|ица|ая|ого|им|ую|их|ей|его|ие|и|ю|а|ы|е|ешь|ет|ем|ит|те)$/','' ,$value);
            //'/[\w]+@[\w]+\.[a-zA-Z]{2,6}/'
        }
        $this->searchArray;
    }

    private function getFirstRegExp()
    {
        $firstRegExp = '';
        foreach($this->stringArray as $value){
            $firstRegExp .= '.*'.$value.'';
        }
        return $firstRegExp;
    }

    private function getSecondRegExp()
    {
        $secondRegExp = '';
        foreach($this->searchArray as $value){
            $secondRegExp .= '.*'.$value;
        }
        return $secondRegExp;
    }

    private function getThirdRegExp()
    {
        $thirdRegExp  = '';
        for($i = 0; $i < (count($this->stringArray)-1); $i++) {
            $thirdRegExp .= $this->stringArray[$i].'|';
        }
        $thirdRegExp .= $this->stringArray[count($this->stringArray)-1].'';
        return $thirdRegExp;
    }

    private function getFourthRegExp()
    {
        $fourthRegExp  = '';
        for($i = 0; $i < (count($this->searchArray)-1); $i++) {
            $fourthRegExp .= $this->searchArray[$i].'|';
        }
        $fourthRegExp .= $this->searchArray[count($this->searchArray)-1];
        return $fourthRegExp;
    }

    private function getSearchList()
    {
        $connection = Connection::getConnection();
        foreach($this->regExpArray as $value){
            $query = $connection->prepare("SELECT * FROM topic WHERE ucase(title) RLIKE ucase(:regulexp)");
            $query->bindParam(':regulexp', $value, \PDO::PARAM_STR);
            $query->execute();
            $this->searchResultArray = $query->fetchAll();// Оставлю пока вывод только самых популярных результатов поиска. Когда будет много результатов, можно сделать расширенным.
        }

    }
}