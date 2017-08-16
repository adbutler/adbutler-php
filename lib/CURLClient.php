<?php

namespace AdButler;

use AdButler\Error\APIConnectionError;
use AdButler\Error\UndefinedRequestParametersError;
use AdButler\Error\UndefinedAPIKeyError;

class CURLClient
{
    private static $api = null;
    private static $instance;
    protected $defaultOptions;

    private $timeout = 80;
    private $connectTimeout = 30;

    public static function getInstance() {
        if (empty(self::$instance)) {
            $class = get_called_class(); // let us instantiate curl client mock
            self::$instance = new $class;
            self::defineUndefinedCURLErrorConstants();
        }
        return self::$instance;
    }

    public static function init( $config = array() ) {
        self::$instance = self::getInstance();
        if ( key_exists('api_key', $config) ) {
            self::$api = $config['api_key'];
        } else {
            throw new UndefinedAPIKeyError(array(
                'object'  => 'error',
                'type'    => 'undefined_api_key_error',
                'status'  => 400,
                'message' => 'No API key was provided.'
            ));
        }
    }
    
    public static function defineUndefinedCURLErrorConstants() {

        $allCURLErrorConstants = array(
            'CURLE_OK'                       => 0,
            'CURLE_UNSUPPORTED_PROTOCOL'     => 1,
            'CURLE_FAILED_INIT'              => 2,
            'CURLE_URL_MALFORMAT'            => 3,
            'CURLE_NOT_BUILT_IN'             => 4,
            'CURLE_COULDNT_RESOLVE_PROXY'    => 5,
            'CURLE_COULDNT_RESOLVE_HOST'     => 6,
            'CURLE_COULDNT_CONNECT'          => 7,
            'CURLE_FTP_WEIRD_SERVER_REPLY'   => 8,
            'CURLE_REMOTE_ACCESS_DENIED'     => 9,
            'CURLE_FTP_ACCEPT_FAILED'        => 10,
            'CURLE_FTP_WEIRD_PASS_REPLY'     => 11,
            'CURLE_FTP_ACCEPT_TIMEOUT'       => 12,
            'CURLE_FTP_WEIRD_PASV_REPLY'     => 13,
            'CURLE_FTP_WEIRD_227_FORMAT'     => 14,
            'CURLE_FTP_CANT_GET_HOST'        => 15,
            'CURLE_HTTP2'                    => 16,
            'CURLE_FTP_COULDNT_SET_TYPE'     => 17,
            'CURLE_PARTIAL_FILE'             => 18,
            'CURLE_FTP_COULDNT_RETR_FILE'    => 19,
            'CURLE_QUOTE_ERROR'              => 21,
            'CURLE_HTTP_RETURNED_ERROR'      => 22,
            'CURLE_WRITE_ERROR'              => 23,
            'CURLE_UPLOAD_FAILED'            => 25,
            'CURLE_READ_ERROR'               => 26,
            'CURLE_OUT_OF_MEMORY'            => 27,
            'CURLE_OPERATION_TIMEDOUT'       => 28,
            'CURLE_FTP_PORT_FAILED'          => 30,
            'CURLE_FTP_COULDNT_USE_REST'     => 31,
            'CURLE_RANGE_ERROR'              => 33,
            'CURLE_HTTP_POST_ERROR'          => 34,
            'CURLE_SSL_CONNECT_ERROR'        => 35,
            'CURLE_BAD_DOWNLOAD_RESUME'      => 36,
            'CURLE_FILE_COULDNT_READ_FILE'   => 37,
            'CURLE_LDAP_CANNOT_BIND'         => 38,
            'CURLE_LDAP_SEARCH_FAILED'       => 39,
            'CURLE_FUNCTION_NOT_FOUND'       => 41,
            'CURLE_ABORTED_BY_CALLBACK'      => 42,
            'CURLE_BAD_FUNCTION_ARGUMENT'    => 43,
            'CURLE_INTERFACE_FAILED'         => 45,
            'CURLE_TOO_MANY_REDIRECTS'       => 47,
            'CURLE_UNKNOWN_OPTION'           => 48,
            'CURLE_TELNET_OPTION_SYNTAX'     => 49,
            'CURLE_PEER_FAILED_VERIFICATION' => 51,
            'CURLE_GOT_NOTHING'              => 52,
            'CURLE_SSL_ENGINE_NOTFOUND'      => 53,
            'CURLE_SSL_ENGINE_SETFAILED'     => 54,
            'CURLE_SEND_ERROR'               => 55,
            'CURLE_RECV_ERROR'               => 56,
            'CURLE_SSL_CERTPROBLEM'          => 58,
            'CURLE_SSL_CIPHER'               => 59,
            'CURLE_SSL_CACERT'               => 60,
            'CURLE_BAD_CONTENT_ENCODING'     => 61,
            'CURLE_LDAP_INVALID_URL'         => 62,
            'CURLE_FILESIZE_EXCEEDED'        => 63,
            'CURLE_USE_SSL_FAILED'           => 64,
            'CURLE_SEND_FAIL_REWIND'         => 65,
            'CURLE_SSL_ENGINE_INITFAILED'    => 66,
            'CURLE_LOGIN_DENIED'             => 67,
            'CURLE_TFTP_NOTFOUND'            => 68,
            'CURLE_TFTP_PERM'                => 69,
            'CURLE_REMOTE_DISK_FULL'         => 70,
            'CURLE_TFTP_ILLEGAL'             => 71,
            'CURLE_TFTP_UNKNOWNID'           => 72,
            'CURLE_REMOTE_FILE_EXISTS'       => 73,
            'CURLE_TFTP_NOSUCHUSER'          => 74,
            'CURLE_CONV_FAILED'              => 75,
            'CURLE_CONV_REQD'                => 76,
            'CURLE_SSL_CACERT_BADFILE'       => 77,
            'CURLE_REMOTE_FILE_NOT_FOUND'    => 78,
            'CURLE_SSH'                      => 79,
            'CURLE_SSL_SHUTDOWN_FAILED'      => 80,
            'CURLE_AGAIN'                    => 81,
            'CURLE_SSL_CRL_BADFILE'          => 82,
            'CURLE_SSL_ISSUER_ERROR'         => 83,
            'CURLE_FTP_PRET_FAILED'          => 84,
            'CURLE_RTSP_CSEQ_ERROR'          => 85,
            'CURLE_RTSP_SESSION_ERROR'       => 86,
            'CURLE_FTP_BAD_FILE_LIST'        => 87,
            'CURLE_CHUNK_FAILED'             => 88,
            'CURLE_NO_CONNECTION_AVAILABLE'  => 89,
            'CURLE_SSL_PINNEDPUBKEYNOTMATCH' => 90,
            'CURLE_SSL_INVALIDCERTSTATUS'    => 91,
            'CURLE_HTTP2_STREAM'             => 92,
        );  
        
        foreach($allCURLErrorConstants as $name => $value) {
            if ( !defined($name) ) {
                define($name, $value);
            }
        }
    }

    public function getTimeout() {
        return $this->timeout;
    }
    public function getConnectTimeout() {
        return $this->connectTimeout;
    }

    public function setTimeout($seconds) {
        $this->timeout = intval(max($seconds, 0));
        return $this;
    }
    public function setConnectTimeout($seconds) {
        $this->connectTimeout = intval(max($seconds, 0));
        return $this;
    }

    // END OF USER DEFINED TIMEOUTS

    /**
     * @param $method
     * @param $url
     * @param null $id
     * @param null $bodyParams - POST or PUT data
     * @param array $queryParams - Filter parameters e.g. zoneID when filtering placements by zone ID
     * @param array $opts - Response modifiers e.g. limit, fields.
     *
     * @return mixed
     * @throws APIConnectionError
     * @throws UndefinedRequestParametersError
     */
    public static function request($method, $url, $id = null, $bodyParams = null, $queryParams = array(), $opts = array()) {

        // throwing error if no data given for POST or PUT request
        if ( ($method === 'POST' || $method === 'PUT') && is_null($bodyParams) ) {
            throw new UndefinedRequestParametersError(array(
                'object'  => 'error',
                'type'    => 'undefined_request_parameters_error',
                'status'  => 400,
                'message' => 'data cannot be null for POST/PUT',
            ));
        }
        
        $requestURL  = self::constructRequestURL($url, $id, $queryParams, $opts);
        $curlOptions = self::constructCURLOptionsArray($method, $bodyParams);
        $response    = static::_makeRequest($requestURL, $curlOptions);

        // CURL Error Handling
        if ($response['error_number'] !== CURLE_OK) {
            $curlErrorMessage = self::getCURLErrorMessage($url, $response['error_number'], $response['error_message']);
            throw new APIConnectionError(array(
                'object'  => 'error',
                'type'    => 'api_connection_error',
                'message' => $curlErrorMessage,
            ));
        }
        
        return $response['response'];
    }
    
    /**
     * @param $url
     * @param $curlOptions
     *
     * @return array
     */
    private static function _makeRequest( $url, $curlOptions ) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $curlOptions);
        $response = curl_exec($ch);
        $result = array(
            'error_number'  => curl_errno($ch),
            'error_message' => curl_error($ch),
            'response'      => $response,
        );
        curl_close($ch);
        return $result;
    }

    /**
     * @param  string $method
     * @param  array  $data
     * @return array
     */
    private static function constructCURLOptionsArray($method, $data) {
        $hasFile     = !is_null($data) && key_exists('file' , $data);
        $contentType = $hasFile ? 'multipart/form-data' : 'application/json';

        $curlInfoArray = curl_version();
        
        $curlOpts = array(
            CURLOPT_HTTPGET        => $method == 'GET',
            CURLOPT_POST           => $method == 'POST',
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: ' . $contentType,
                'Authorization: Basic ' . self::$api,
                'X-AdButler-Requestor: ' . php_uname(),
                'X-AdButler-PHP-Client: true',
                'X-AdButler-PHP-Client-Version: 1.0.5',
                'X-AdButler-PHP-Version: ' . phpversion(),
                'X-AdButler-PHP-CURL-Version: ' . $curlInfoArray['version'],
                'Expect: ',
            ),
        );

        // passing an array to CURLOPT_POSTFIELDS will encode the data as multipart/form-data,
        // while passing a URL-encoded string will encode the data as application/x-www-form-urlencoded.
        if ($method === 'POST' || $method === 'PUT') {
            $curlOpts[CURLOPT_POSTFIELDS] = $hasFile ? $data : json_encode($data);
        }

        if ($method === 'PUT') {
            $curlOpts[CURLOPT_HTTPHEADER][] = 'X-HTTP-Method-Override: PUT';
        }

        if ($method === 'DELETE') {
            $curlOpts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        }
        
        return $curlOpts;
    }

    /**
     * @param  string $url
     * @param  int    $id
     * @param  array  $queryParams
     * @param  array  $opts
     *
     * @return string
     */
    public static function constructRequestURL($url, $id, $queryParams, $opts) {
        $qParams = $queryParams + $opts;
        
        if (array_key_exists('fields', $qParams)) {
            $qParams['fields'] = join(',', array_map('rawurlencode', $qParams['fields']));
        }
        
        $qParams = empty($qParams) ? "" : "?" . http_build_query($qParams);
        
        $id = empty($id) ? "" : "/$id";
        
        // TODO: add all parameters to the URL. Also URL encode it
        // TODO: add all options to the URL. Also URL encode it.
        return "$url$id$qParams";
    }
    
    /**
     * @param $url
     * @param $errNum
     * @param $message
     * @return string The curl error message
     */
    private static function getCURLErrorMessage($url, $errNum, $message)
    {
        switch ($errNum) {
            case CURLE_COULDNT_CONNECT:      // 7
            case CURLE_COULDNT_RESOLVE_HOST: // 6
            case CURLE_OPERATION_TIMEDOUT :  // 28
                $msg = "Could not connect to AdButler ($url).  Please check your "
                     . "internet connection and try again.  If this problem persists, "
                     . "you should check AdButler's service status at "
                     . "https://twitter.com/adbutlerstatus, or " // TODO: use the actual adbutler status page
                     . "let us know at api@adbutler.com.";   // TODO: use the actual support email
                break;

            case CURLE_SSL_CACERT: // 60
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify AdButler's SSL certificate.  Please make sure "
                     . "that your network is not intercepting certificates.  "
                     . "(Try going to $url in your browser.)  "
                     . "If this problem persists, let us know at api@adbutler.com."; // TODO: use the actual support email
                break;

            case CURLE_URL_MALFORMAT : // 3
                $msg = "The URL \"$url\" was not properly formatted.";
                break;

            case CURLE_UNSUPPORTED_PROTOCOL : // 1
                $msg = "libcurl does not support the protocol you used in the URL \"$url\". "
                     . "The support might be a compile-time option that you didn't use,"
                     . "it can be a misspelled protocol string or just a protocol libcurl has no code for.";
                break;

            case CURLE_FAILED_INIT : // 2
                $msg = "Very early initialization code failed. "
                     . "This is likely to be an internal error or problem, "
                     . "or a resource problem where something fundamental couldn't get done at init time.";
                break;

            case CURLE_NOT_BUILT_IN : // 4
                $msg = "A requested feature, protocol or option was not found built-in in this libcurl due to a build-time decision. "
                     . "This means that a feature or option was not enabled or explicitly disabled when libcurl was built and in order to get it to function you have to get a rebuilt libcurl.";
                break;

            case CURLE_COULDNT_RESOLVE_PROXY : // 5
                $msg = "Couldn't resolve proxy. The given proxy host could not be resolved.";
                break;

            case CURLE_FTP_WEIRD_SERVER_REPLY : // 8
                $msg = "After connecting to a FTP server, libcurl expects to get a certain reply back. This error code implies that it got a strange or bad reply. The given remote server is probably not an OK FTP server.";
                break;

            case CURLE_REMOTE_ACCESS_DENIED : // 9
                $msg = "We were denied access to the resource given in the URL. For FTP, this occurs while trying to change to the remote directory.";
                break;

            case CURLE_FTP_ACCEPT_FAILED : // 10
                $msg = "While waiting for the server to connect back when an active FTP session is used, an error code was sent over the control connection or similar.";
                break;

            case CURLE_FTP_WEIRD_PASS_REPLY : // 11
                $msg = "After having sent the FTP password to the server, libcurl expects a proper reply. This error code indicates that an unexpected code was returned.";
                break;

            case CURLE_FTP_ACCEPT_TIMEOUT : // 12
                $msg = "During an active FTP session while waiting for the server to connect, the CURLOPT_ACCEPTTIMEOUT_MS (or the internal default) timeout expired.";
                break;

            case CURLE_FTP_WEIRD_PASV_REPLY : // 13
                $msg = "libcurl failed to get a sensible result back from the server as a response to either a PASV or a EPSV command. The server is flawed.";
                break;

            case CURLE_FTP_WEIRD_227_FORMAT : // 14
                $msg = "FTP servers return a 227-line as a response to a PASV command. If libcurl fails to parse that line, this return code is passed back.";
                break;

            case CURLE_FTP_CANT_GET_HOST : // 15
                $msg = "An internal failure to lookup the host used for the new connection.";
                break;

            case CURLE_HTTP2 : // 16
                $msg = "A problem was detected in the HTTP2 framing layer. This is somewhat generic and can be one out of several problems, see the error buffer for details.";
                break;

            case CURLE_FTP_COULDNT_SET_TYPE : // 17
                $msg = "Received an error when trying to set the transfer mode to binary or ASCII.";
                break;

            case CURLE_PARTIAL_FILE : // 18
                $msg = "A file transfer was shorter or larger than expected. This happens when the server first reports an expected transfer size, and then delivers data that doesn't match the previously given size.";
                break;

            case CURLE_FTP_COULDNT_RETR_FILE : // 19
                $msg = "This was either a weird reply to a 'RETR' command or a zero byte transfer complete.";
                break;

            case CURLE_QUOTE_ERROR : // 21
                $msg = "When sending custom \"QUOTE\" commands to the remote server, one of the commands returned an error code that was 400 or higher (for FTP) or otherwise indicated unsuccessful completion of the command.";
                break;

            case CURLE_HTTP_RETURNED_ERROR : // 22
                $msg = "This is returned if CURLOPT_FAILONERROR is set TRUE and the HTTP server returns an error code that is >= 400.";
                break;

            case CURLE_WRITE_ERROR : // 23
                $msg = "An error occurred when writing received data to a local file, or an error was returned to libcurl from a write callback.";
                break;

            case CURLE_UPLOAD_FAILED : // 25
                $msg = "Failed starting the upload. For FTP, the server typically denied the STOR command. The error buffer usually contains the server's explanation for this.";
                break;

            case CURLE_READ_ERROR : // 26
                $msg = "There was a problem reading a local file or an error returned by the read callback.";
                break;

            case CURLE_OUT_OF_MEMORY : // 27
                $msg = "A memory allocation request failed. This is serious badness and things are severely screwed up if this ever occurs.";
                break;

            case CURLE_FTP_PORT_FAILED : // 30
                $msg = "The FTP PORT command returned error. This mostly happens when you haven't specified a good enough address for libcurl to use. See CURLOPT_FTPPORT.";
                break;

            case CURLE_FTP_COULDNT_USE_REST : // 31
                $msg = "The FTP REST command returned error. This should never happen if the server is sane.";
                break;

            case CURLE_RANGE_ERROR : // 33
                $msg = "The server does not support or accept range requests.";
                break;

            case CURLE_HTTP_POST_ERROR : // 34
                $msg = "This is an odd error that mainly occurs due to internal confusion.";
                break;

            case CURLE_SSL_CONNECT_ERROR : // 35
                $msg = "A problem occurred somewhere in the SSL/TLS handshake. You really want the error buffer and read the message there as it pinpoints the problem slightly more. Could be certificates (file formats, paths, permissions), passwords, and others.";
                break;

            case CURLE_BAD_DOWNLOAD_RESUME : // 36
                $msg = "The download could not be resumed because the specified offset was out of the file boundary.";
                break;

            case CURLE_FILE_COULDNT_READ_FILE : // 37
                $msg = "A file given with FILE:// couldn't be opened. Most likely because the file path doesn't identify an existing file. Did you check file permissions?";
                break;

            case CURLE_LDAP_CANNOT_BIND : // 38
                $msg = "LDAP cannot bind. LDAP bind operation failed.";
                break;

            case CURLE_LDAP_SEARCH_FAILED : // 39
                $msg = "LDAP search failed.";
                break;

            case CURLE_FUNCTION_NOT_FOUND : // 41
                $msg = "Function not found. A required zlib function was not found.";
                break;

            case CURLE_ABORTED_BY_CALLBACK : // 42
                $msg = "Aborted by callback. A callback returned \"abort\" to libcurl.";
                break;

            case CURLE_BAD_FUNCTION_ARGUMENT : // 43
                $msg = "Internal error. A function was called with a bad parameter.";
                break;

            case CURLE_INTERFACE_FAILED : // 45
                $msg = "Interface error. A specified outgoing interface could not be used. Set which interface to use for outgoing connections' source IP address with CURLOPT_INTERFACE.";
                break;

            case CURLE_TOO_MANY_REDIRECTS : // 47
                $msg = "Too many redirects. When following redirects, libcurl hit the maximum amount. Set your limit with CURLOPT_MAXREDIRS.";
                break;

            case CURLE_UNKNOWN_OPTION : // 48
                $msg = "An option passed to libcurl is not recognized/known. Refer to the appropriate documentation. This is most likely a problem in the program that uses libcurl. The error buffer might contain more specific information about which exact option it concerns.";
                break;

            case CURLE_TELNET_OPTION_SYNTAX : // 49
                $msg = "A telnet option string was Illegally formatted.";
                break;

            case CURLE_PEER_FAILED_VERIFICATION : // 51
                $msg = "The remote server's SSL certificate or SSH md5 fingerprint was deemed not OK.";
                break;

            case CURLE_GOT_NOTHING : // 52
                $msg = "Nothing was returned from the server, and under the circumstances, getting nothing is considered an error.";
                break;

            case CURLE_SSL_ENGINE_NOTFOUND : // 53
                $msg = "The specified crypto engine wasn't found.";
                break;

            case CURLE_SSL_ENGINE_SETFAILED : // 54
                $msg = "Failed setting the selected SSL crypto engine as default!";
                break;

            case CURLE_SEND_ERROR : // 55
                $msg = "Failed sending network data.";
                break;

            case CURLE_RECV_ERROR : // 56
                $msg = "Failure with receiving network data.";
                break;

            case CURLE_SSL_CERTPROBLEM : // 58
                $msg = "problem with the local client certificate.";
                break;

            case CURLE_SSL_CIPHER : // 59
                $msg = "Couldn't use specified cipher.";
                break;

            case CURLE_SSL_CACERT : // 60
                $msg = "Peer certificate cannot be authenticated with known CA certificates.";
                break;

            case CURLE_BAD_CONTENT_ENCODING : // 61
                $msg = "Unrecognized transfer encoding.";
                break;

            case CURLE_LDAP_INVALID_URL : // 62
                $msg = "Invalid LDAP URL.";
                break;

            case CURLE_FILESIZE_EXCEEDED : // 63
                $msg = "Maximum file size exceeded.";
                break;

            case CURLE_USE_SSL_FAILED : // 64
                $msg = "Requested FTP SSL level failed.";
                break;

            case CURLE_SEND_FAIL_REWIND : // 65
                $msg = "When doing a send operation curl had to rewind the data to retransmit, but the rewinding operation failed.";
                break;

            case CURLE_SSL_ENGINE_INITFAILED : // 66
                $msg = "Initiating the SSL Engine failed.";
                break;

            case CURLE_LOGIN_DENIED : // 67
                $msg = "The remote server denied curl to login (Added in 7.13.1)";
                break;

            case CURLE_TFTP_NOTFOUND : // 68
                $msg = "File not found on TFTP server.";
                break;

            case CURLE_TFTP_PERM : // 69
                $msg = "Permission problem on TFTP server.";
                break;

            case CURLE_REMOTE_DISK_FULL : // 70
                $msg = "Out of disk space on the server.";
                break;

            case CURLE_TFTP_ILLEGAL : // 71
                $msg = "Illegal TFTP operation.";
                break;

            case CURLE_TFTP_UNKNOWNID : // 72
                $msg = "Unknown TFTP transfer ID.";
                break;

            case CURLE_REMOTE_FILE_EXISTS : // 73
                $msg = "File already exists and will not be overwritten.";
                break;

            case CURLE_TFTP_NOSUCHUSER : // 74
                $msg = "This error should never be returned by a properly functioning TFTP server.";
                break;

            case CURLE_CONV_FAILED : // 75
                $msg = "Character conversion failed.";
                break;

            case CURLE_CONV_REQD : // 76
                $msg = "Caller must register conversion callbacks.";
                break;

            case CURLE_SSL_CACERT_BADFILE : // 77
                $msg = "Problem with reading the SSL CA cert (path? access rights?)";
                break;

            case CURLE_REMOTE_FILE_NOT_FOUND : // 78
                $msg = "The resource referenced in the URL does not exist.";
                break;

            case CURLE_SSH : // 79
                $msg = "An unspecified error occurred during the SSH session.";
                break;

            case CURLE_SSL_SHUTDOWN_FAILED : // 80
                $msg = "Failed to shut down the SSL connection.";
                break;

            case CURLE_AGAIN : // 81
                $msg = "Socket is not ready for send/recv wait till it's ready and try again. "
                     . "This return code is only returned from curl_easy_recv and curl_easy_send (Added in 7.18.2)";
                break;

            case CURLE_SSL_CRL_BADFILE : // 82
                $msg = "Failed to load CRL file (Added in 7.19.0)";
                break;

            case CURLE_SSL_ISSUER_ERROR : // 83
                $msg = "Issuer check failed (Added in 7.19.0)";
                break;

            case CURLE_FTP_PRET_FAILED : // 84
                $msg = "The FTP server does not understand the PRET command at all or does not support the given argument. "
                     . "Be careful when using CURLOPT_CUSTOMREQUEST, a custom LIST command will be sent with PRET CMD before PASV as well. (Added in 7.20.0)";
                break;

            case CURLE_RTSP_CSEQ_ERROR : // 85
                $msg = "Mismatch of RTSP CSeq numbers.";
                break;

            case CURLE_RTSP_SESSION_ERROR : // 86
                $msg = "Mismatch of RTSP Session Identifiers.";
                break;

            case CURLE_FTP_BAD_FILE_LIST : // 87
                $msg = "Unable to parse FTP file list (during FTP wildcard downloading).";
                break;

            case CURLE_CHUNK_FAILED : // 88
                $msg = "Chunk callback reported error.";
                break;

            case CURLE_NO_CONNECTION_AVAILABLE : // 89
                $msg = "(For internal use only, will never be returned by libcurl) No connection available, the session will be queued. (added in 7.30.0)";
                break;

            case CURLE_SSL_PINNEDPUBKEYNOTMATCH : // 90
                $msg = "Failed to match the pinned key specified with CURLOPT_PINNEDPUBLICKEY.";
                break;

            case CURLE_SSL_INVALIDCERTSTATUS : // 91
                $msg = "Status returned failure when asked with CURLOPT_SSL_VERIFYSTATUS.";
                break;

            case CURLE_HTTP2_STREAM : // 92
                $msg = "Stream error in the HTTP/2 framing layer.";
                break;

            default:
                $msg = "Unexpected error communicating with AdButler. "
                     . "If this problem persists, let us know at api@adbutler.com."; // TODO: use the actual support email
        }

        $msg .= " (Network error # $errNum)";

        return $msg;
    }


}



