<?php
/*
 * Copyright 2022 Autisid (https://autisid.it)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Autisid\OpenIDConnect\Jwk;

use Lcobucci\JWT\Signer\Key;
use Autisid\OpenIDConnect\JwtSigningAlgorithm;

class JwkSigner implements \Lcobucci\JWT\Signer
{
    /**
     * @inheritDoc
     */
    public function algorithmId(): string
    {
        return 'jwk';
    }

    /**
     * @inheritDoc
     */
    public function sign(string $payload, Key $key): string
    {
        assert($key instanceof Jwk);
        $alg = $key->getAlgorithm();

        return JwtSigningAlgorithm::fromName($alg)
            ->getSigner()
            ->sign($payload, Key\InMemory::plainText($key->contents()));
    }

    /**
     * @inheritDoc
     */
    public function verify(string $expected, string $payload, Key $key): bool
    {
        assert($key instanceof Jwk);
        $alg = $key->getAlgorithm();

        return JwtSigningAlgorithm::fromName($alg)
            ->getSigner()
            ->verify($expected, $payload, Key\InMemory::plainText($key->contents()));
    }
}
