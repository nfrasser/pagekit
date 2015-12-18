<template>

    <div class="uk-form-horizontal">

        <div class="uk-form-row">
            <span class="uk-form-label">Pages</span>
            <div class="uk-form-controls uk-form-controls-text" v-if="config.menus">

                <input-tree :active.sync="widget.nodes"></input-tree>

            </div>
        </div>

    </div>

</template>

<script>

    module.exports = {

        section: {
            label: 'Visibility',
            priority: 100
        },

<<<<<<< HEAD
        inherit: true,

        props: ['widget'],

        ready: function () {

            var nodes = _(this.config.nodes).groupBy('menu').value();

            this.$set('menus', _.mapValues(this.config.menus, function (menu, id) {

                return _.extend(menu, {

                    nodes: _(nodes[id] || {}).sortBy('priority').groupBy('parent_id').value(),

                    getNodes: function (node) {
                        return node ? this.nodes[node.id] : this.nodes[0];
                    }

                });
            }));
=======
        data: function () {
          return {
              menus: false
          }
>>>>>>> develop
        },

        props: ['widget', 'config', 'form']

    }

</script>
