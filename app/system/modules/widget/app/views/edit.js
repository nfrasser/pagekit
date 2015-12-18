module.exports = {

    el: '#widget-edit',

    mixins: [window.Widgets],

    data: function () {
<<<<<<< HEAD
        return _.merge({form: {}}, window.$data);
=======
        return _.merge({form: {}, sections: []}, window.$data);
>>>>>>> develop
    },

    created: function () {

        var sections = [], type = _.kebabCase(this.widget.type), active;

<<<<<<< HEAD
        // set position from get param
        if (!this.widget.id) {
            var match = new RegExp('[?&]position=([^&]*)').exec(location.search);
            this.widget.position = (match && decodeURIComponent(match[1].replace(/\+/g, ' '))) || '';
        }
    },
=======
        _.forIn(this.$options.components, function (component, name) {
>>>>>>> develop

            var options = component.options || {};

            if (options.section) {
                sections.push(_.extend({name: name, priority: 0}, options.section));
            }

        });

        sections = _.sortBy(sections.filter(function (section) {

<<<<<<< HEAD
                var options = component.options || {};

                if (options.section) {
                    sections.push(_.extend({name: name, priority: 0}, options.section));
                }
=======
            active = section.name.match('(.+):(.+)');

            if (active === null) {
                return !_.find(sections, {name: type + ':' + section.name});
            }
>>>>>>> develop

            return active[1] == type;
        }, this), 'priority');

        this.$set('sections', sections);

    },

    ready: function () {

        UIkit.tab(this.$els.tab, {connect: this.$els.content});
        // this.$set('widget.data', _.defaults({}, this.widget.data, this.type.defaults));

        // set position from get param
        if (!this.widget.id) {
            var match = new RegExp('[?&]position=([^&]*)').exec(location.search);
            this.widget.position = (match && decodeURIComponent(match[1].replace(/\+/g, ' '))) || '';
        }

    },

    methods: {

        save: function () {
            this.$broadcast('save', {widget: this.widget});
            this.$resource('api/site/widget/:id').save({id: this.widget.id}, {widget: this.widget}).then(function (res) {

                var data = res.data;

                this.$dispatch('saved');

                if (!this.widget.id) {
                    window.history.replaceState({}, '', this.$url.route('admin/site/widget/edit', {id: data.widget.id}));
                }

                this.$set('widget', data.widget);

                this.$notify('Widget saved.');
            }, function (res) {
                this.$notify(res.data, 'danger');
            });
        },

        cancel: function () {
            this.$dispatch('cancel');
        }

<<<<<<< HEAD
    },

    filters: {

        active: function (sections) {

            var type = _.kebabCase(this.widget.type), active;

            return sections.filter(function (section) {

                active = section.name.match('(.+):(.+)');

                if (active === null) {
                    return !_.find(sections, {name: type + ':' + section.name});
                }

                return active[1] == type;
            }, this);
        }

    },

    mixins: [window.Widgets]
=======
    }
>>>>>>> develop

};

Vue.ready(module.exports);
