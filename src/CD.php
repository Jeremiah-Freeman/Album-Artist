<?php
    class CD
    {
        private $title;
        private $artist;

        function __construct($title , $artist) {
            $this->title = $title;
            $this->artist = $artist;
        }
        function getTitle(){
            return $this->title;
        }
        function getArtist() {
            return $this->artist;
        }
        function setTitle($new_title) {
            $this->title = $new_title;
        }
        function setArtist($new_artist) {
            $this->artist = $new_artist;
        }
        function save() {
            array_push($_SESSION["list_of_CDs"], $this);
        }
        static function getAll() {
          return $_SESSION["list_of_CDs"];
        }
    }








?>
