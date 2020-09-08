# Avataaars plugin for Craft CMS 3.x

With Avataaars for Craft CMS you can create avatar icons by combining clothes, hair, emotions, accessories, and colors. This plugin is based on the Avataaars set designed by Pablo Stanley and the HTTP API provided by Dicebear.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require remcoov/avataaars

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Avataaars.

## Using Avataaars

In your twig templates, you can create a lot of different Avataaars by playing with all the [available settings](#available-settings). The Avataaar icon used for this Craft CMS plugin, for example, is made with the following settings:

```
{% set avataaar = craft.avataaars.avataaar({
    seed: 'avataaar',
    radius: 0,
    width: 200,
    height: 200,
    margin: 0,
    background: 'CCCCCC',
    style: 'circle',
    top: 'shortHair',
    hatColor: 'red',
    hairColor: 'black',
    accessories: 'prescription02',
    facialHair: 'majestic',
    facialHairColor: 'black',
    clothes: 'hoodie',
    clothesColor: 'pink',
    eyes: 'happy',
    eyebrow: 'flat',
    mouth: 'smile',
    skin: 'light',
    svg: false
}) %}

<img src="{{ avataaar }}" />
```

## Available settings

#### seed
The value of _seed_ can be anything you like - but don't use any sensitive or personal data here!

#### radius
Avatar border radius. Max: `50`

#### width
Fixed width

#### height
Fixed height

#### margin
Avatar margin in percent. Max: `25`

#### background
Only hex (3-digit, 6-digit and 8-digit) values are allowed. For example: `FF0000`

#### style
`transparent` or `circle`

#### top
`longHair`, `shortHair`, `eyepatch`, `hat`, `hijab` or `turban`

#### hatColor
`black`, `blue`, `gray`, `heather`, `pastel`, `pink`, `red` or `white`


#### hairColor
`auburn`, `black`, `blonde`, `brown`, `pastel`, `platinum`, `red` or `gray`

#### accessories
`kurt`, `prescription01`, `prescription02`, `round`, `sunglasses` or `wayfarers`

#### facialHair
`medium`, `light`, `majestic`, `fancy` or `magnum`

#### facialHairColor
`auburn`, `black`, `blonde`, `brown`, `platinum` or `red`

#### clothes
`blazer`, `sweater`, `shirt`, `hoodie` or `overall`

#### clothesColor
`black`, `blue`, `gray`, `heather`, `pastel`, `pink`, `red` or `white`

#### eyes
`close`, `cry`, `default`, `dizzy`, `roll`, `happy`, `hearts`, `side`, `squint`, `surprised`, `wink` or `winkWacky`

#### eyebrow
`angry`, `default`, `flat`, `raised`, `sad`, `unibrow` or `up`

#### mouth
`concerned`, `default`, `disbelief`, `eating`, `grimace`, `sad`, `scream`, `serious`, `smile`, `tongue`, `twinkle` or `vomit`

#### skin
`tanned`, `yellow`, `pale`, `light`, `brown`, `darkBrown` or `black`

#### svg
When you'd like to output the Avataaar as raw SVG code, you'd want to set this to `true`. Example:

```
{% set avataaar = craft.avataaars.avataaar({
    svg: true
}) %}

{{ svg(avataaar) }}
```

If you would like to add a class to the SVG:

```
{{ svg(avataaar)|attr({ class: 'avataaar-icon' }) }}
```

## Random Avataaar

You can also output a random Avataaar by simply doing the following:

`<img src="{{ craft.avataaars.avataaar }}" />`

## Form to set Craft CMS user photo

You can render a form on the front-end to let (logged in) users set a rendered Avataaar as their Craft CMS user photo. To do this, add the following code:

```
{% set user = user ?? currentUser %}
{% if user %}

    <form method="POST" id="userPhoto-form">
        {{ craft.avataaars.userPhotoForm|raw }}
        
        <input type="hidden" name="width" value="300" />
        <input type="hidden" name="height" value="300" />
        <input type="hidden" name="background" value="" /> <!-- f.e. FF0000 -->
        <input type="hidden" name="margin" value="" /> <!-- max. 25 -->

        {{ csrfInput() }}
        <div class="userPhoto-result">
            <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8Xw8AAoMBgDTD2qgAAAAASUVORK5CYII=' id="userPhoto-result-img" />
        </div>

        <input id="userPhoto-submit" type="submit" value="Set user photo" >
    </form>

{% endif %}
```

The form has a couple of hidden configurations for you as a developer to set, since these are probably too 'technical' for the user: `width`, `height`,`background` and `margin`.

When the user sets the profile picture and you want to do something on either `success` or `error`, you can use the following Javascript code:

```
window.addEventListener('userPhotoStatus', function (e) {
    console.log(e.detail.status);
}, false);
```

A note beforehand: remember to set the volume for user photo storage.

Brought to you by [remcoov](https://github.com/remcoov) and [kevinmu17](https://github.com/kevinmu17)