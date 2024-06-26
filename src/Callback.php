<?php
namespace fop;
use fop\Crypt\FopBizDataCrypt;
use fop\Exception\ErrorCode;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use think\response\Json;

class Callback {
    protected $request;
    protected $crypt;
    public function __construct(Request $request, FopBizDataCrypt $crypt)
    {
        $this->request = $request;
        $this->crypt = $crypt;
    }

    /**
     * @throws Exception
     */
    public function getReqBody(): string
    {
        try {
            return $this->crypt->getReqBody($this->request->getContent());
        }catch (Exception $e){
            throw new Exception(ErrorCode::getCodeMsg(ErrorCode::$aesDecodeFail),ErrorCode::$aesDecodeFail);
        }
    }

    /**
     * @throws Exception
     */
    public function setRespBody(string $content): array
    {
        $data = $this->crypt->getRespBody($content);
        if(empty($data)){
            throw new Exception(ErrorCode::getCodeMsg(ErrorCode::$reqBodyEncodeFail),ErrorCode::$reqBodyEncodeFail);
        }
        return $data;
    }
}