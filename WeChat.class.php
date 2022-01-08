<?php

class WeChat{
    //文字模板
    private	$textTpl = "<xml>
 						<ToUserName><![CDATA[%s]]></ToUserName>
 						<FromUserName><![CDATA[%s]]></FromUserName>
 						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[text]]></MsgType>
 						<Content><![CDATA[%s]]></Content>
 						<FuncFlag>0</FuncFlag>
 						</xml>";
    //单条图片模板
    private $singleTpl = "<xml>
 						  <ToUserName><![CDATA[%s]]></ToUserName>
						  <FromUserName><![CDATA[%s]]></FromUserName>
						  <CreateTime>%s</CreateTime>
						  <MsgType><![CDATA[news]]></MsgType>
						  <ArticleCount>1</ArticleCount>
						  <Articles>
						  <item>
						  <Title><![CDATA[%s]]></Title>
						  <Description><![CDATA[%s]]></Description>
						  <PicUrl><![CDATA[%s]]></PicUrl>
						  <Url><![CDATA[%s]]></Url>
						  </item>
						  </Articles>
						  <FuncFlag>0</FuncFlag>
						  </xml>";
    private $appId = '';
    private $appSecret = '';
    private $encodingAESKey = '';
    private $state = '';

    //初始化appId,appSecret,encodingAESKey
    public function __construct($appId = '', $appSecret = '', $encodingAESKey = ''){
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->encodingAESKey = $encodingAESKey;
    }

    //获取accessToken
    public function getAccessToken(){
        if(empty($this->appId) && empty($this->appSecret)) exit("appId或者appSecret错误");
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
        $accessTokenJson = $this->sendGetRequest($url);
        if($accessTokenJson == '') return '';
        else{
            $accessTokenArr = json_decode($accessTokenJson, true);
            if(empty($accessTokenArr['errcode']) AND !empty($accessTokenArr['access_token'])){
                return $accessTokenArr['access_token'];
            }else return '';
        }
    }
    /*
     *
     *自定义菜单创建
     * param array $menu, string $accessToken
     *
     */
    public function createMenu($menu, $accessToken){
        if(is_array($menu)) 
            $postMenu = urldecode(json_encode($menu));        
        else 
            return -1;
        
        if(!empty($accessToken))
            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$accessToken}";
        else 
            return -1;
        
        $result = $this->sendPostRequest($url, $postMenu);
        if($result == '')
        {
            return -1;
        }
        
        $result = json_decode($result,true);
        return $result['errcode'];
    }
    
    /*
     *
     * 生成二维码
     * param int $scene_id, string $accessToken
     *
     */
    public function createQrcode($scene_id, $accessToken){
        if($scene_id <= 0 || 100000 <= $scene_id  ) 
            return array('errcode'=>'-1');
        
        if(empty($accessToken))
            return array('errcode'=>'-1');        
        
        $info = array('action_name'=>'QR_LIMIT_SCENE', 
            'action_info'=>array('scene'=>array('scene_id'=>$scene_id)));
        $postData = urldecode(json_encode($info));        
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$accessToken}";

        $result = $this->sendPostRequest($url, $postData);
        if($result == '')
        {
            return array('errcode'=>'-1');
        }
        
        $result = json_decode($result,true);
        return $result;
    }
    
    public function getFanList($accessToken, $nextopenid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$accessToken}&next_openid={$nextopenid}";
        $fanlist = $this->sendGetRequest($url);
        $fanlist = json_decode($fanlist, true);
        return $fanlist;
    }
    
    /*
     *使用oAuth的access_token拉取用户的详细信息
     *return Array
     */ 
    public function getFanInfo($accessToken, $openId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$accessToken}&openid={$openId}&lang=zh_CN";
        $userMesJson = $this->sendGetRequest($url);
        if($userMesJson != ''){
            $userMesArr = json_decode($userMesJson, true);
            if(!empty($userMesArr['errcode'])){
                return array();
            }
        }else $userMesArr = array();
        return $userMesArr;
    }

    /*
     * 发送模板消息
     * param Array $data 模板消息
     *
     */
    public function sendTempletMsg($accessToken, $data){
        if(!is_array($data))
        {
            return -2;
        }
        
        if(!empty($accessToken))
        {
            return -3;
        }
        
        $data = urldecode(json_encode($data));
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$accessToken}";
        $result = $this->sendPostRequest($url, $data);
        if( !empty($result))
        {
            $result = json_decode($result,true);
            if($result['errcode'] == 0)
            {
                return 0;
            }
        }
        
        return -1;
    }

    /*
     * 添加模板
     * param Array $data 模板编号
     *
     */
    public function addTempletId($accessToken, $data){
        if(empty($accessToken)) 
            return -3;
        $url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token={$accessToken}";
        $data = json_encode($data);
        $templetIdJson = $this->sendPostRequest($url, $data);
        if(empty($templetIdJson)) 
        {
            return -2;
        }
        else
        {
            $templetIdArr = json_decode($templetIdJson, true);
            if($templetIdArr['errcode'] == 0){
                return $templetIdArr['template_id'];
            }
            else
            {
                return -1;
            }
        }
    }
    
    public function uploadMedia($accesstoken, $type, $filepath)
    {
        $data = array( "media"=>"@".$filepath  );
        if(class_exists('CURLFile'))
        {
            $data = array('fieldname'=>new \CURLFile($filepath, 'image/jpeg'));
        } else {
            $data = array ('fieldname' => '@' . $filepath );             
        }
        $url= "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$accesstoken}&type={$type}";
        
        //$data = urldecode(json_encode($data));
        $result = $this->sendPostUploadRequest($url, $data);
        if( !empty($result))
        {
            $result = json_decode($result,true);
            return $result;
        }
        return array('errcode'=>'-1');
    }
    
    public function uploadOneNews($accesstoken, $mediaid, $author, $title, $content, $contenturl )
    {
        $content = htmlspecialchars_decode($content); 
        $content = str_replace('"',"'", $content);
        
        $news = array();
        $news[] = array( "thumb_media_id"=>urlencode($mediaid),
                       "author"=>urlencode($author),
                       "title"=>urlencode($title),
                       "content_source_url"=>$contenturl,
                       "content"=>urlencode($content) );
        $data = array("articles"=>$news);
         
        $data = urldecode(json_encode($data));
        $url= "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token={$accesstoken}";
        
        $result = $this->sendPostRequest($url, $data);
        if( !empty($result))
        {
            $result = json_decode($result,true);
            return $result;
        }
        return array('errcode'=>'-1');
    }
    
    public function sendNews($accessToken, $groupid, $mediaid ){
        
        if(empty($accessToken))
        {
            return array('errcode'=>'-1');
        }
        
        $data = array( "filter"=>array( "groupid"=>"0" ),
                       "mpnews"=>array( "media_id"=>$mediaid ),
                       "msgtype"=>"mpnews" );
        
        $data = urldecode(json_encode($data));
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$accessToken}";
        $result = $this->sendPostRequest($url, $data);
        if( !empty($result))
        {
            $result = json_decode($result,true);
            return $result;
        }
        
        return array('errcode'=>'-1');
    }

    /*
     *用户授权
     *
     */ 
    public function oAuthValidate($code){
        if(empty($code)) return array();
        $oAuthAccessTokenArr = $this->getoAuthAccessToken($code);
        if(!empty($oAuthAccessTokenArr)){
            $userMesArr = $this->getUserDetailMes($oAuthAccessTokenArr['access_token'], $oAuthAccessTokenArr['openid']);
            if(!isset($userMesArr['errcode'])){
                $userMesArr['refresh_token'] = $oAuthAccessTokenArr['refresh_token'];
                return $userMesArr;
            }else {
                return array();
            }
        }else return array();
    }

    /*
     *刷新oAuth的access_token
     *return 
     */ 
    public function refreshoAuthAccessToken($refreshToken){
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$this->appId}&grant_type=refresh_token&refresh_token={$refreshToken}";
        $oAuthAccessTokenJson = $this->sendGetRequest($url);
        if($oAuthAccessTokenJson != ''){
            $oAuthAccessTokenArr = json_decode($oAuthAccessTokenJson, true);
            if(isset($oAuthAccessTokenArr['errcodeerrcode'])){
                exit("failed");
            }
        }else $oAuthAccessTokenArr = array();
        return $oAuthAccessTokenArr;
    }

    /*
     *获取oAuth的access_token
     *return Array
     */ 
    public function getoAuthAccessToken($code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appId}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";
        $oAuthAccessTokenJson = $this->sendGetRequest($url);
        if(!empty($oAuthAccessTokenJson)) {
            $oAuthAccessTokenArr = json_decode($oAuthAccessTokenJson, true);
            if(isset($oAuthAccessTokenArr['errcode'])){
                return array();
            } 
        }else $oAuthAccessTokenArr = array();
        return $oAuthAccessTokenArr;
    }

    /*
     *使用oAuth的access_token拉取用户的详细信息
     *return Array
     */ 
    public function getUserDetailMes($oAuthAccessToken, $openId){
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$oAuthAccessToken}&openid={$openId}&lang=zh_CN";
        $userMesJson = $this->sendGetRequest($url);
        if($userMesJson != ''){
            $userMesArr = json_decode($userMesJson, true);
            if(!empty($userMesArr['errcode'])){
                return array();
            }
        }else $userMesArr = array();
        return $userMesArr;
    }

    /*
     * 拼接text
     * param string $text：要发送的内容
     * string $fromUserName 发送者openId
     * string $toUserName 接受节openId
     */
    public function transmitToText($text, $fromUserName, $toUserName){
        $time = time();
        $msg = sprintf($this->textTpl, $toUserName, $fromUserName, $time, $text);
        return $msg;
    }
    
    /*
     * 拼接News
     * param string $text：要发送的内容
     * string $fromUserName 发送者openId
     * string $toUserName 接受节openId
     */
    public function transmitToNews($text, $title, $description, $picurl, $url, $fromUserName, $toUserName){
        $time = time();
        $msg = sprintf($this->singleTpl, $toUserName, $fromUserName, $time, $title, $description, $picurl, $url, $text);
        return $msg;
    }
    
    
    

    /*
     *
     *  发送get请求
     * param string $url
     *
     */
    private function sendGetRequest($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        //if(!empty($header)) curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result =  curl_exec($ch);
        if (curl_errno($ch)) return '';     //curl_errno返回错误号，没错返回0
        else return $result;
    }

    /*
     *
     *  发送post请求
     *  param string $url, string $data
     *
     */
    private function sendPostRequest($url, $data = ''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Content-Length: ' . strlen($data)));
        if($data != '')
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $errno = curl_errno($ch);
        if($errno) return '';
        else return $result;
    }
    
    private function sendPostUploadRequest($url, $data = ''){
        
        $curl = curl_init (); 	
        
        if(class_exists('CURLFile'))
        { 
            curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, true ); 
        } else { 
            if (defined ( 'CURLOPT_SAFE_UPLOAD' )) { 
                curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false ); 	
            }
        }
     
        curl_setopt ( $curl, CURLOPT_URL, $url ); 
     	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE ); 
     	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); 
        
        if (! empty ( $data )) { 		
           curl_setopt ( $curl, CURLOPT_POST, 1 ); 	
           curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); 	
      	}
 	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); 
        $result = curl_exec ( $curl );
        curl_close ( $curl ); 	
      	return $result;
   
    }

    
}