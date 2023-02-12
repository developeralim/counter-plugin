<?php
      namespace Counter;
      
      use GuzzleHttp\Client;  
      use GuzzleHttp\Exception\RequestException;
      
      class Crawler {

            /**
             * Fetch data from target url and remove script,style and head tag
             * then return only text
             * @param string $url refers to target URL
             * @return string content 
             */
            public function __invoke ( string $url ) 
            {    
                  $client = new Client();
                  
                  $response = $client->get($url);
                  $content = $response->getBody()->getContents();
                  
                  $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
                  $content = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $content);
                  $content = preg_replace('#<head>(.*?)</head>#is', '', $content);
                  $content = strip_tags($content);
                  return $content;
            }

      } 