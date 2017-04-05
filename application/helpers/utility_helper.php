<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('backend_asset_url()')) {

    function backend_asset_url()
    {
        return base_url() . 'media/backend/';
    }

}
if (!function_exists('frontend_asset_url()')) {

    function frontend_asset_url()
    {
        return base_url() . 'media/frontend/';
    }

}

/**
 * 
 * @param File $file
 * @param string $upload_dir
 * @param string $file_types
 * @param int $max_file_size
 * @return multitype:number unknown |multitype:number string unknown
 */
function uploadImage($file, $upload_dir, $file_types, $max_file_size, $file_name = "")
{
    $status = array();
    $status['status'] = 0;
    $original_file_name = clean(basename($file["name"]));
    $files = explode(".", $original_file_name);
    $file_extention = end($files);
    if ($file_name == "") {
        $file_name = $files[0];
    }

    $target_file = $upload_dir . microtime(true) . $file_name . "." . $file_extention;
    $msg = validateFile($target_file, $file, $max_file_size, $file_types);
    if ($msg != "success") {
        $status['status'] = 0;
        $status['msg'] = $msg;
        return $status;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $paths = explode("/", $target_file);
            array_shift($paths);
            $status['status'] = 1;
            $status['msg'] = "The file " . basename($file["name"]) . " has been uploaded.";
            $status['image'] = implode("/", $paths);
            return $status;
        } else {
            $status['status'] = 0;
            $status['msg'] = "Sorry, there was an error uploading your file.";
            return $status;
        }
    }
}

function validateFile($target_file, $file, $max_file_size, $file_types)
{
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if ($file["size"] > $max_file_size) {
        return "File size is too large.";
    }
    $imageFileType = strtolower($imageFileType);
    if (!in_array($imageFileType, $file_types)) {
        return "Sorry, only " . implode(",", $file_types) . " files are allowed.";
    }
    return "success";
}

function clean($string)
{
    $string = preg_replace('/\s+/', '-', $string);
    return preg_replace('/[^A-Za-z0-9\-.]/', '-', $string);
}

/**
 * Get user IP
 * @return string
 */
function getRealIP()
{
    $headers = array('HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_VIA', 'HTTP_X_COMING_FROM', 'HTTP_COMING_FROM', 'HTTP_CLIENT_IP');
    foreach ($headers as $header) {
        if (isset($_SERVER [$header])) {
            if (($pos = strpos($_SERVER [$header], ',')) != false) {
                $ip = substr($_SERVER [$header], 0, $pos);
            } else {
                $ip = $_SERVER [$header];
            }
            $ipnum = ip2long($ip);
            if ($ipnum !== - 1 && $ipnum !== false && (long2ip($ipnum) === $ip)) {
                if (($ipnum - 184549375) && ($ipnum - 1407188993) && ($ipnum - 1062666241))
                    if (($pos = strpos($_SERVER [$header], ',')) != false) {
                        $ip = substr($_SERVER [$header], 0, $pos);
                    } else {
                        $ip = $_SERVER [$header];
                    }
                return $ip;
            }
        }
    }
    return $_SERVER ['REMOTE_ADDR'];
}

function isPermitted($resource_id, $activity)
{
    $upermissions = $_SESSION['fbuserpermissions'];
    $key = array_search($resource_id, array_column($upermissions, 'resource_id'));
    $resource_permission = $upermissions[$key];
    $activity = $activity . '_permission';
    if ($resource_permission[$activity] == 'Y') {
        return true;
    } else {
        return false;
    }
}

function downloadExcel($data, $fileName)
{
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");

    $flag = false;
    foreach ($data as $row) {
        if (!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";
    }
}

function filterData(&$str)
{

    $str = trim(preg_replace('/\s\s+/', ' ', $str));
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

/**
 * Get Post Load ID
 * @param integer load ID
 * @return string load ID
 */
function getLoadCode($load_id)
{
    $postid = str_pad($load_id, 5, '0', STR_PAD_LEFT);
    $postid = "PL" . $postid;
    return $postid;
}

/**
 * Get Post Load ID
 * @param integer load ID
 * @return string load ID
 */
function getQuoteCode($load_id)
{
    $quotetid = str_pad($load_id, 5, '0', STR_PAD_LEFT);
    $quotetid = "Q" . $quotetid;
    return $quotetid;
}

/**
 * Get Post Truck ID
 * @param integer truck ID
 * @return string truck ID
 */
function getTruckCode($truck_id)
{
    $truckid = str_pad($truck_id, 5, '0', STR_PAD_LEFT);
    $truckid = "PT" . $truckid;
    return $truckid;
}

/**
 * Get Quantum Load ID
 * @param integer load ID
 * @return string load ID
 */
function getQuantumLoadCode($id)
{
    $qlid = str_pad($id, 5, '0', STR_PAD_LEFT);
    $qlid = "QL" . $qlid;
    return $qlid;
}

/**
 * Get Trip Code
 * @param integer trip ID
 * @return string trip code
 */
function getTripCode($trip_id)
{
    $tripid = str_pad($trip_id, 5, '0', STR_PAD_LEFT);
    $tripid = "TR" . $tripid;
    return $tripid;
}

/**
 * Get Invoice Code
 * @param integer invoice ID
 * @return string invoice code
 */
function getInvoiceCode($invoice_id)
{
    $tripid = str_pad($invoice_id, 5, '0', STR_PAD_LEFT);
    $tripid = "IN" . $invoice_id;
    return $invoice_id;
}

/**
 * Get Econfirmation Code
 * @param integer Econfirmation ID
 * @return string Econfirmation code
 */
function getEconfirmCode($econfirm_id)
{
    $econfirmid = str_pad($econfirm_id, 5, '0', STR_PAD_LEFT);
    $econfirmid = "C" . $econfirmid;
    return $econfirmid;
}

/**
 * Get Ineteger ID
 * @param string ID
 * @return integer ID
 */
function getIntId($id)
{
    $intid = intval(preg_replace('/[^0-9]+/', '', $id), 10);
    return $intid;
}

/**
 * Get Truck Booking Code
 * @param integer Booking ID
 * @return string Booking code
 */
function getBookingCode($booking_id)
{
    $bookingid = str_pad($booking_id, 5, '0', STR_PAD_LEFT);
    $bookingid = "BR" . $bookingid;
    return $bookingid;
}

function getLatLong($string)
{
    $latlng = array();
    $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($string) . "&sensor=true";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $details_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);
    //print_r($response);
    if ($response['status'] != 'OK') {
        $latlng['lat'] = "";
        $latlng['lng'] = "";
    } else {
        $geometry = $response['results'][0]['geometry'];
        $latlng['lat'] = $geometry['location']['lat'];
        $latlng['lng'] = $geometry['location']['lng'];
    }
    return $latlng;
}

function getGoogleDistance($fTdata)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?mode=driving&key=AIzaSyBtGPmn8ziQzPa8kbmciGjEwfIBdyvf4Zs";
    $params = array();
    $params['origins'] = $fTdata['from_lat'] . ", " . $fTdata['from_lng'];
    $params['destinations'] = $fTdata['to_lat'] . ", " . $fTdata['to_lng'];
    $url = $url . "&" . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    $result = json_decode($output, true);
    $distance = $result['rows'][0]['elements'][0]['distance']['value'];
    return $distance;
}

function getReferralCode($hash_length, $id)
{
    $code = random36($hash_length) . $id;
    $hash = str_split($code);
    shuffle($hash);
    return strtoupper(implode("", $hash));
}

function random36($length = 6)
{
    $str = '';
    $len = 1;
    while ($len <= $length) {
        $str .= substr(base_convert(mt_rand(60466176, 2147483647), 10, 36), 0, $length);
        $len = strlen($str);
    }
    return substr($str, 0, $length);
}
