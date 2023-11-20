<?php

require(__DIR__ . "/vendor/autoload.php");

use App\Validation\Rules\EmailRule;
use App\Validation\Rules\ExcludeIfRule;
use App\Validation\Rules\InListRule;
use App\Validation\Rules\MustBeBeforeOrEqualsDateRule;
use App\Validation\Rules\NullableRule;
use App\Validation\Rules\RequiredIfRule;
use App\Validation\Rules\RequiredRule;
use App\Validation\Validator;

$adult = "adult";
$child = "child";
$rules = [
    "forwho" => [
        new RequiredRule(),
        new InListRule([$adult, $child]),
    ],
    "lname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "fname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "childname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "childfname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "cntname" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "phone_number" => [
        new RequiredRule(),
    ],
    "email" => [
        new RequiredRule(),
        new EmailRule(),
    ],
    "addr" => [
        new RequiredRule(),
    ],
    "cpost" => [
        new RequiredRule(),
    ],
    "loc" => [
        new RequiredRule(),
    ],
    "birthdate" => [
        new RequiredRule(),
        new MustBeBeforeOrEqualsDateRule(date("Y/m/d"))
    ],
    "mut" => [
        new RequiredRule(),
    ],
    "natnumber" => [
        new RequiredRule(),
    ],
    "reason" => [
        new RequiredRule(),
    ],
    "orig" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $adult),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $child),
    ],
    "origchild" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "syear" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "schtype" => [
        new RequiredIfRule("forwho", fn ($forWho) => $forWho == $child),
        new ExcludeIfRule("forwho", fn($forWho) => $forWho == $adult),
    ],
    "message" => [
        new NullableRule(),
    ]
];

$valdidator = new Validator($rules, $_POST);

Validator::rawDisplay($valdidator);

if($valdidator->validate()){
    //La validation est passée
    //substitut du $_POST, les données devant être exclues n'y seront pas.
    $validatedData = $valdidator->getValidatedData();
} else {
    //Une ou plusieurs règles n'ont pas été respectées.
    //Il faudra afficher les messages d'erreurs.
    $errorMessages = $valdidator->getErrorValidationMessages();
}


