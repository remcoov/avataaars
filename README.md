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
    skin: 'light'
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
`medium`, `light`, `majestic`, `fancy` or magnum

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

## Random Avataaar

You can also output a random Avataaar by simply doing the following:

`<img src="{{ craft.avataaars.avataaar }}" />`

Brought to you by [remcoov](https://github.com/remcoov)