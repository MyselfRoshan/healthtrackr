<?php
class ExampleSeeder
{
    protected $table = "example";
    protected $single_row = array(
        "col1" => "value1"
    );
    protected $multiple_row = array(
        [
            "col1" => "value1"
        ],
        [
            "col1" => "value2"
        ]
    );
    static public function seed()
    {

    }
}
