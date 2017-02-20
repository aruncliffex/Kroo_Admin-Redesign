<?php

 require 'aws-autoloader.php';
 use Aws\Sns\SnsClient;
 Use Aws\CacheInterface;
 Use Aws\Sns\Exception;

// if(isset($_GET['submit']))
// {
    $push_message = $_GET['push_message'];

    if(!empty($push_message))
    {
    
        // Create a new Amazon SNS client
        $sns = SnsClient::factory(array(
            'region' => 'us-west-2',
            'version' => 'latest',
            'credentials' => array(
            )
        ));
        
        //print_r($sns);

        // region code samples: us-east-1, ap-northeast-1, sa-east-1, ap-southeast-1, ap-southeast-2, us-west-2, us-gov-west-1, us-west-1, cn-north-1, eu-west-1

        $iOS_AppArn = "arn:aws:sns:us-west-2:729779362209:app/APNS/TheKroo";
//        $android_AppArn = "<android app's Application ARN>";

        // Get the application's endpoints
        $iOS_model = $sns->listEndpointsByPlatformApplication(array('PlatformApplicationArn' => $iOS_AppArn));

        print_r($iOS_model);
        exit();
         
        foreach ($iOS_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];
            echo $endpointArn;
        }

        // Display all of the endpoints for the android application
        // foreach ($android_model['Endpoints'] as $endpoint)
        // {
        //     $endpointArn = $endpoint['EndpointArn'];
        //     echo $endpointArn;
        // }

        // iOS: Send a message to each endpoint
        foreach ($iOS_model['Endpoints'] as $endpoint)
        {
            $endpointArn = $endpoint['EndpointArn'];

            try
            {
                $sns->publish(array('Message' => $push_message,
                    'TargetArn' => $endpointArn));

                echo "<strong>Success:</strong> ".$endpointArn."<br/>";
            }
            catch (Exception $e)
            {
                echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
            }
        }

        // android: Send a message to each endpoint
        // foreach ($android_model['Endpoints'] as $endpoint)
        // {
        //     $endpointArn = $endpoint['EndpointArn'];

        //     try
        //     {
        //         $sns->publish(array('Message' => $push_message,
        //             'TargetArn' => $endpointArn));

        //         echo "<strong>Success:</strong> ".$endpointArn."<br/>";
        //     }
        //     catch (Exception $e)
        //     {
        //         echo "<strong>Failed:</strong> ".$endpointArn."<br/><strong>Error:</strong> ".$e->getMessage()."<br/>";
        //     }
        // }
    }
// }   
?>
