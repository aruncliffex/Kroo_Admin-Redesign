<?php
/**
 *  Use of these functions isn't required, but does go a long way to simplify the curl interations
 *  by providing functions that more clearly express what's going on. If you're comfortable with curl
 *  or prefer to use another request object, this is up to you.
 */

/**
 *  Used by the other functions to handle array merging of the curl options
 */
function mergeCurlOptions(array $defaults, array $optionsToAdd) {
  if(!$optionsToAdd) {
    return $defaults;
  }

  if(array_key_exists(CURLOPT_HTTPHEADER,$optionsToAdd)) {
    if(array_key_exists(CURLOPT_HTTPHEADER, $defaults)) {
      $defaultHeaders = $defaults[CURLOPT_HTTPHEADER];
      $additionalHeaders = $optionsToAdd[CURLOPT_HTTPHEADER];

      $mergedHeaders = $defaultHeaders + $additionalHeaders;
      $defaults[CURLOPT_HTTPHEADER] = $mergedHeaders;
      unset($optionsToAdd[CURLOPT_HTTPHEADER]);
    }
  }

  $mergedOptions = $defaults + $optionsToAdd;

  return $mergedOptions;
}

/**
 *  Handles execution of the curl operation and returns an array with the results
 */
function executeCurl($curl) {
    $response = curl_exec($curl);

    $error = curl_error($curl);
    $result = array( 'header' => '',
                     'body' => '',
                     'curl_error' => '',
                     'http_code' => '',
                     'last_url' => '');
    if ( $error != "" )
    {
        $result['curl_error'] = $error;
        return $result;
    }

    $header_size = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
    $result['header'] = substr($response, 0, $header_size);
    $result['body'] = substr( $response, $header_size );
    $result['http_code'] = curl_getinfo($curl,CURLINFO_HTTP_CODE);
    $result['last_url'] = curl_getinfo($curl,CURLINFO_EFFECTIVE_URL);
    curl_close($curl);
    return $result;
}

/**
 *  Initializes a curl object with default options, optionally an array of curl options
 *  can be passed in.
 */
function getCurl($url, array $options = null) {
  $defaults = array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HEADER => 1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0
    );

  if(!$options) {
    $curlOptions = $defaults;
  } else {
    $curlOptions = mergeCurlOptions($defaults, $options);
  }

  $curl = curl_init($url);
  curl_setopt_array($curl, $curlOptions);

  return $curl;
}

/**
 *  Configures a curl object for form posting by getting a post request
 *  and setting the content-type to 'application/x-www-form-urlencoded'
 */
function getCurlForFormPost($url) {
  $curlOptions = array(CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded"));
  $curl = getCurlForPost($url,$curlOptions);

  return $curl;
}

/**
 *  Configures a curl request object for a post operation by adding CURLOPT_POST => 1 to the options
 */
function getCurlForPost($url,array $options = null) {
  $defaults = array(
      CURLOPT_POST => 1
    );

  $curlOptions = mergeCurlOptions($defaults,$options);
  return getCurl($url, $curlOptions);
}

/**
 *  Handles taking the body of the request to post and turning it into the proper request string
 *  form posting is different than a json post in that the request parameters are url encoded together
 *  with &'s
 *  If you want to do a JSON body this is not the function to use.
 */
function setFormData($curl,$params) {
  $params = http_build_query($params);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
  return $curl;
}

/**
 *  Handles getting a curl object configured to post json, passing in a php array style object
 *  to turn into JSON
 */
function getCurlForJSONPost($url, $data) {
  $data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
  $options = array(
      CURLOPT_POSTFIELDS => $data_string,
      CURLOPT_HTTPHEADER => array('Content-Type: application/json','Content-Length: ' . strlen($data_string))
  );

  $curl = getCurlForPost($url,$options);
  return $curl;
}