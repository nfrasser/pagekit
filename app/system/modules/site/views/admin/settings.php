<?php $view->script('site-settings', 'system/site:app/bundle/settings.js', ['vue', 'editor']) ?>

<<<<<<< HEAD
<form id="settings" name="form" class="uk-form uk-form-horizontal" v-on="submit: save | valid" v-cloak>
=======
<form id="settings" class="uk-form uk-form-horizontal" v-validator="form" @submit.prevent="save | valid" v-cloak>
>>>>>>> develop

    <div class="uk-grid pk-grid-large" data-uk-grid-margin>
        <div class="pk-width-sidebar">

            <div class="uk-panel">

                <ul class="uk-nav uk-nav-side pk-nav-large" v-el:tab>
                    <li :class="{'uk-active': section.active}" v-for="section in sections | orderBy 'priority'"><a><i class="uk-icon-justify uk-icon-small uk-margin-right {{ section.icon }}"></i> {{ section.label | trans }}</a></li>
                </ul>

            </div>

        </div>
        <div class="uk-flex-item-1">

<<<<<<< HEAD
            <ul class="uk-switcher uk-margin" v-el="content">
                <li v-repeat="section: sections | orderBy 'priority'">
                    <component is="{{ section.name }}" config="{{@ config }}" form="{{@ form }}"></component>
=======
            <ul class="uk-switcher uk-margin" v-el:content>
                <li v-for="section in sections | orderBy 'priority'">
                    <component :is="section.name" :config.sync="config"></component>
>>>>>>> develop
                </li>
            </ul>

        </div>
    </div>

</form>
