<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of spreadsheetController
 *
 * @author caroa
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
Class SpreadSheetController {

    CONST SPREADSHEETID = '1GZu4w8_NiJS8I1--C-N5O2dPoj_Bv-ojekMRDS2ToMQ';
    CONST AUTHCODE = "4/swFjBx4CB0o4P8t5ZI8yhizfQnl7XKLnXIbcNdDvS-tF4gQ-t0kHJXQ";

    private function getClient() {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP Quickstart');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $client->setAuthConfig(__DIR__ . '/../core/credentials.json');
        $client->setAccessType('offline');
        //$client->setPrompt('select_account consent');
// Load previously authorized token from a file, if it exists.
// The file token.json stores the user's access and refresh tokens, and is
// created automatically when the authorization flow completes for the first
// time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

// If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
// Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
// Request authorization from the user.
                $authCode = self::AUTHCODE;

// Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

// Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }

            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    public function GetRange(Model $model) {
        $range = $model->getRange();
        $client = $this->getClient();
        $service = new Google_Service_Sheets($client);
        $response = $service->spreadsheets_values->get(self::SPREADSHEETID, $range);
        $values = $response->getValues();
        if (empty($values)) {
            return FALSE;
        } else {
            return $values;
        }
    }

}
