<?php

class ReviewsControllerTest extends TestCase {

    public function testapiAddReviews() {

        $my = new UserController();
        $data = '{"name":"name668854","heading_id":"2","text":"tgerger","author":"ggt","tags":["2"],"news":["100"]}';
        $response = $this->call('POST', 'addreviews', [], [], ['Accept: application/json', 'Content-Type: application/json'], $data);

        $resp = $response->getContent();
        $resp_decode = json_decode($resp, true);
        $name = $resp_decode = json_decode($data, true);
//        var_dump($resp_decode);
        $this->assertEquals($name['name'], $resp_decode['name']);
        $this->assertResponseStatus(200);
    }

    public function testapiEditReviews() {

        $my = new ReviewsController();
        $data = '{"id":"117", "text":"123123123123123"}';
        $response = $this->call('POST', 'editreviews', [], [], ['Accept: application/json', 'Content-Type: application/json'], $data);

        $resp = $response->getContent();
        $resp_decode = json_decode($resp, true);
        var_dump($resp_decode);
        $id = json_decode($data, true);
        $this->assertEquals($id['id'], $resp_decode['id']);
        $this->assertEquals($id['text'], $resp_decode['text']);
//        var_dump($resp_decode);
        $this->assertResponseStatus(200);
    }

    public function testfindByText() {

        $my = new ReviewsController();
        $data = '{"data":"7"}';
        $response = $this->call('POST', 'findbytext', [], [], ['Accept: application/json', 'Content-Type: application/json'], $data);
        $resp = $response->getContent();
        $mass = json_decode($resp, true);
//        $mass = array ($test);
//        var_dump($mass);
        foreach($mass as $id){
        $this->assertArrayHasKey("id", $id);
        }
        foreach($mass as $var){
            $this->assertArrayHasKey("heading_id", $var);

            $this->assertArrayHasKey("text", $var);

            $this->assertArrayHasKey("name", $var);

            $this->assertArrayHasKey("author", $var);

            $this->assertArrayHasKey("news", $var);

            $this->assertArrayHasKey("tags", $var);
        }
        foreach($mass as $name){
        $a = substr_count($name['name'], '7');
//            var_dump($a);
        $this->assertGreaterThanOrEqual(1, $a);
        }
        $this->assertResponseStatus(200);
    }

    public function testfindByTag() {

        $my = new ReviewsController();
        $data = '{"data":"euro"}';
        $response = $this->call('POST', 'findbytag', [], [], ['Accept: application/json', 'Content-Type: application/json'], $data);
        $resp = $response->getContent();
        $mass = json_decode($resp, true);
//        var_dump($mass);
//        $exp = '{"success":false,"message":"Bad request"}';
//        $this->assertJsonStringEqualsJsonString($exp,$resp);
        $this->assertArrayHasKey("News", $mass);
        $this->assertArrayHasKey("Reviews", $mass);
        $this->assertNotEmpty($mass);

        $this->assertResponseStatus(200);
    }

    public function testapiDelReviews() {

        $my = new ReviewsController();
        $id = '118';
        $response = $this->call('DELETE', "reviewsdel/$id");
        $resp = $response->getContent();
        $resp_decode = json_decode($resp, true);
        $this->assertEquals($id, $resp_decode['id']);
//        var_dump($resp_decode);

    }

    public function testapiSingleReviews() {

        $my = new ReviewsController();
        $id = '116';
        $response = $this->call('GET', "singlereview/$id");
        $resp = $response->getContent();
        $resp_decode = json_decode($resp, true);
        $this->assertEquals($id, $resp_decode['id']);
        $this->assertResponseStatus(200);
    }
}
