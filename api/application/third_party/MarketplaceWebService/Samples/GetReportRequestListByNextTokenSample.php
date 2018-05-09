<?php
/** 
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     MarketplaceWebService
 *  @copyright   Copyright 2009 Amazon Technologies, Inc.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2009-01-01
 */
/******************************************************************************* 

 *  Marketplace Web Service PHP5 Library
 *  Generated: Thu May 07 13:07:36 PDT 2009
 * 
 */

/**
 * Get Report List  Sample
 */

include_once ('.config.inc.php'); 

/************************************************************************
* Uncomment to configure the client instance. Configuration settings
* are:
*
* - MWS endpoint URL
* - Proxy host and port.
* - MaxErrorRetry.
***********************************************************************/
// IMPORTANT: Uncomment the approiate line for the country you wish to
// sell in:
// United States:
//$serviceUrl = "https://mws.amazonservices.com";
// United Kingdom
//$serviceUrl = "https://mws.amazonservices.co.uk";
// Germany
//$serviceUrl = "https://mws.amazonservices.de";
// France
//$serviceUrl = "https://mws.amazonservices.fr";
// Italy
//$serviceUrl = "https://mws.amazonservices.it";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn";
// Canada
//$serviceUrl = "https://mws.amazonservices.ca";
// India
$serviceUrl = "https://mws.amazonservices.in";

$config = array (
  'ServiceURL' => $serviceUrl,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3,
);

/************************************************************************
 * Instantiate Implementation of MarketplaceWebService
 * 
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants 
 * are defined in the .config.inc.php located in the same 
 * directory as this sample
 ***********************************************************************/
 $service = new MarketplaceWebService_Client(
     AWS_ACCESS_KEY_ID, 
     AWS_SECRET_ACCESS_KEY, 
     $config,
     APPLICATION_NAME,
     APPLICATION_VERSION);
 
/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebService
 * responses without calling MarketplaceWebService service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebService/Mock tree
 *
 ***********************************************************************/
 // $service = new MarketplaceWebService_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out 
 * sample for Get Report List Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MarketplaceWebService_Model_GetReportListRequest
 // object or array of parameters
 
$nextToken = '8Pew/s10kwv2jpZedg0wbVuY6vtoszFEgjFHUIoqgzjUKndRMBhbgCTGhLgVYx3apBu0dxq68CnEQY1DSk1TQZ1h3Yfci6scWu2hWqJcP+Vr4nw4fcw+q2nhfuMmvK2A7qUcW1f7FtVv6aKcEg7SZnXvc0Kb9yw7PxuuVZAjoAG5Hd34Twm1igafEPREmauvQPEfQK/OReL7FqzgXAk0N1arVwlcGAn9bkQr4Y8wsVF63lOvC2k/3zpDoyzLBt2VDfO+TAepFjPAmFn1WoCVxpBXB4E+38NgGgsFAudwYDmpdF2SHWmVtfA/l46VkvhokXi0eegSu/IBBmR7xToRhMCDvCkO8JoFlU3jmocbyRZXEAdAhZe1BqSxCSB7pEe6DJ6J5u33/1t1By6WRojZzsBAanjycYd1/xuQ4lwWIncIZriy6roJeak64qgbitAqZMVymGhxchlqXq2N1aintyTl5kM2M34LfrrDeRBZ0q4=';
     
$parameters = array (
  'Merchant' => MERCHANT_ID,
  'NextToken' => $nextToken,
  //'MWSAuthToken' => '<MWS Auth Token>', // Optional
);
$request = new MarketplaceWebService_Model_GetReportRequestListByNextTokenRequest($parameters);
 
// $request = new MarketplaceWebService_Model_GetReportRequestListByNextTokenRequest();
// $request->setMerchant(MERCHANT_ID);
// $request->setNextToken($nextToken);
// $request->setMWSAuthToken('<MWS Auth Token>'); // Optional
// 
echo "<pre>";
invokeGetReportRequestListByNextToken($service, $request);

                                                                    
/**
  * Get Report Request List By Next Token Action Sample
  * returns a list of reports; by default the most recent ten reports,
  * regardless of their acknowledgement status
  *   
  * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
  * @param mixed $request MarketplaceWebService_Model_GetReportRequestListByNextTokenRequest or array of parameters
  */
  function invokeGetReportRequestListByNextToken(MarketplaceWebService_Interface $service, $request) 
  {
      try {
              $response = $service->getReportRequestListByNextToken($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        GetReportRequestListByNextTokenResponse\n");
                if ($response->isSetGetReportRequestListByNextTokenResult()) { 
                    echo("            GetReportRequestListByNextTokenResult\n");
                    $getReportRequestListByNextTokenResult = $response->getGetReportRequestListByNextTokenResult();
                    if ($getReportRequestListByNextTokenResult->isSetNextToken()) 
                    {
                        echo("                NextToken\n");
                        echo("                    " . $getReportRequestListByNextTokenResult->getNextToken() . "\n");
                    }
                    if ($getReportRequestListByNextTokenResult->isSetHasNext()) 
                    {
                        echo("                HasNext\n");
                        echo("                    " . $getReportRequestListByNextTokenResult->getHasNext() . "\n");
                    }
                    $reportRequestInfoList = $getReportRequestListByNextTokenResult->getReportRequestInfoList();
                    foreach ($reportRequestInfoList as $reportRequestInfo) {
                        echo("                ReportRequestInfo\n");
                    if ($reportRequestInfo->isSetReportRequestId()) 
                          {
                              echo("                    ReportRequestId\n");
                              echo("                        " . $reportRequestInfo->getReportRequestId() . "\n");
                          }
                          if ($reportRequestInfo->isSetReportType()) 
                          {
                              echo("                    ReportType\n");
                              echo("                        " . $reportRequestInfo->getReportType() . "\n");
                          }
                          if ($reportRequestInfo->isSetStartDate()) 
                          {
                              echo("                    StartDate\n");
                              echo("                        " . $reportRequestInfo->getStartDate()->format(DATE_FORMAT) . "\n");
                          }
                          if ($reportRequestInfo->isSetEndDate()) 
                          {
                              echo("                    EndDate\n");
                              echo("                        " . $reportRequestInfo->getEndDate()->format(DATE_FORMAT) . "\n");
                          }
                          // add start
                          if ($reportRequestInfo->isSetScheduled()) 
                          {
                              echo("                    Scheduled\n");
                              echo("                        " . $reportRequestInfo->getScheduled() . "\n");
                          }
                          // add end
                          if ($reportRequestInfo->isSetSubmittedDate()) 
                          {
                              echo("                    SubmittedDate\n");
                              echo("                        " . $reportRequestInfo->getSubmittedDate()->format(DATE_FORMAT) . "\n");
                          }
                          if ($reportRequestInfo->isSetReportProcessingStatus()) 
                          {
                              echo("                    ReportProcessingStatus\n");
                              echo("                        " . $reportRequestInfo->getReportProcessingStatus() . "\n");
                          }
                          // add start
                          if ($reportRequestInfo->isSetGeneratedReportId()) 
                          {
                              echo("                    GeneratedReportId\n");
                              echo("                        " . $reportRequestInfo->getGeneratedReportId() . "\n");
                          }
                          if ($reportRequestInfo->isSetStartedProcessingDate()) 
                          {
                              echo("                    StartedProcessingDate\n");
                              echo("                        " . $reportRequestInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "\n");
                          }
                          if ($reportRequestInfo->isSetCompletedDate()) 
                          {
                              echo("                    CompletedDate\n");
                              echo("                        " . $reportRequestInfo->getCompletedDate()->format(DATE_FORMAT) . "\n");
                          }
                          // add end
                    }
                } 
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        echo("                RequestId\n");
                        echo("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

                echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
     } catch (MarketplaceWebService_Exception $ex) {
         echo("Caught Exception: " . $ex->getMessage() . "\n");
         echo("Response Status Code: " . $ex->getStatusCode() . "\n");
         echo("Error Code: " . $ex->getErrorCode() . "\n");
         echo("Error Type: " . $ex->getErrorType() . "\n");
         echo("Request ID: " . $ex->getRequestId() . "\n");
         echo("XML: " . $ex->getXML() . "\n");
         echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
     }
 }
 ?>
