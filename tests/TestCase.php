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

use Autisid\OpenIDConnect\Client;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function client(): Client {
        $oidc = (new Client())
            ->providerUrl(env('OIDC_PROVIDER_URL'))
            ->clientId(env('OIDC_CLIENT_ID'))
            ->clientSecret(env('OIDC_CLIENT_SECRET'))
            ->redirectUri(env('OIDC_REDIRECT_URI'));
        $this->assertInstanceOf(Client::class, $oidc);
        return $oidc;
    }
}
