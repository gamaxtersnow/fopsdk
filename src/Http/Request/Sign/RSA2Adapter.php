<?php
    namespace fop\Http\Request\Sign;


    use fop\Exception\SignException;
    use fop\Internal\Util\FopSignature;

    class RSA2Adapter {
        /**
         * @throws SignException
         */
        public function sign(string $publicKey, string $content): string
            {
                return FopSignature::getSign($publicKey,$content);
            }
    }