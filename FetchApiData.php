<?php

require_once "vendor/autoload.php";
use GuzzleHttp\Client;
class FetchApiData {
  private static $domain = 'https://www.innoraft.com';
  // This variable is used to store the api url.
  private $url;
  // This array contains title of every services
  public $heading = [];
  // This array contains main image of every services.
  public $hero_images = [];
  // This array contains icons of every services.
  public $icons = [];
  // This array contains details of every services.
  public $details = [];
  /**
   * This constructor is used to set url
   *
   * @param string
   */
  function __constructor($api_url) {
    $this->url = $api_url;
  }
  public function request(string $links) {
    $client = new Client();
    $data = $client->request('GET',$links);
    return json_decode($data->getBody(),true);
  }
  /**
   * This function is used to get data from api and set data to class variable.
   */
  function setApiData() {
    $client = new Client();
    $response =
    $client->request('GET', 'https://www.innoraft.com/jsonapi/node/services');
    $request = json_decode($response->getBody(), true);
    array_push($this->heading,$request['data']['15']['attributes']
    ['field_secondary_title']['value']);
    $requested_hero_img = $request['data']['15']['relationships']['field_image']
    ['links']['related']['href'];
    $hero_img_request = $client->request('GET',$requested_hero_img);
    $hero_img_response = json_decode($hero_img_request->getBody(), true);
    array_push($this->hero_images, self::$domain . $hero_img_response['data']
    ['attributes']['uri']['url']);
    // Get service icons.string
    $field_service_icon_data = $this->request($request['data']['15']
    ['relationships']['field_service_icon']['links']['related']['href']);
    $icon_arr = [];
    foreach ($field_service_icon_data['data'] as $element) {
      $field_media_image_data = $this->request($element['relationships']
      ['field_media_image']['links']['related']['href']);
      array_push($icon_arr, self::$domain . $field_media_image_data['data']
      ['attributes']['uri']['url']);
    }
    array_push($this->icons, $icon_arr);
    // Get details of service (in html list).
    array_push($this->details, $request['data']['15']['attributes']
    ['field_services']['value']);
    for($i=12;$i<=14;$i++) {
      //Get title
      array_push($this->heading,$request['data'][$i]['attributes']
      ['field_secondary_title']['value']);
      //Get hero img
      $requested_hero_img = $request['data'][$i]['relationships']['field_image']
      ['links']['related']['href'];
      $hero_img_request = $client->request('GET',$requested_hero_img);
      $hero_img_response = json_decode($hero_img_request->getBody(), true);
      array_push($this->hero_images, self::$domain . $hero_img_response['data']
      ['attributes']['uri']['url']);
      // Get service icons.string
      $field_service_icon_data = $this->request($request['data'][$i]
      ['relationships']['field_service_icon']['links']['related']['href']);
      $icon_arr = [];
      foreach ($field_service_icon_data['data'] as $element) {
        $field_media_image_data = $this->request($element['relationships']
        ['field_media_image']['links']['related']['href']);
        array_push($icon_arr, self::$domain . $field_media_image_data['data']
        ['attributes']['uri']['url']);
      }
      array_push($this->icons, $icon_arr);
      // Get details of service (in html list).
      array_push($this->details, $request['data'][$i]['attributes']
      ['field_services']['value']);
    }
  }
}
?>


