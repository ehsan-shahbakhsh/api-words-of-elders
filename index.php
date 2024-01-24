<?php

class WordsOfElders
{
    private array $baseAPI = [
        'ok' => false,
        'status' => 400,
        'result' => []
    ];

    public function __construct()
    {
        try {
            $data = json_decode(file_get_contents("data.json"), true);
            http_response_code(200);
            $this->baseAPI['ok'] = true;
            $this->baseAPI['status'] = 200;
            $this->baseAPI['result'] = $data[array_rand($data)];
        } catch (Exception $e) {
            http_response_code(500);
            $this->baseAPI['status'] = 500;
            unset($this->baseAPI['result']);
            $this->baseAPI['error'] = 'Something wrong';
            $this->baseAPI['info'] = 'در لود کردن دیتاست مشکلی پیش آمده است';
        }
    }

    public function __toString(): string
    {
        header("Content-Type: application/json");
        return json_encode($this->baseAPI);
    }
}
echo new WordsOfElders;
