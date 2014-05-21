@script('user', 'system/js/user/edit.js', 'requirejs')

<form id="js-user" class="uk-form uk-form-horizontal" action="@url.route('@system/user/save')" method="post">

    <div class="pk-toolbar">
        <button class="uk-button uk-button-primary" type="submit">@trans('Save')</button>
        <a class="uk-button" href="@url.route('@system/user/index')">@( user.id ? trans('Close') : trans('Cancel') )</a>
    </div>

    <div class="uk-grid uk-grid-divider" data-uk-grid-margin data-uk-grid-match>
        <div class="uk-width-medium-1-4 pk-sidebar-left">

            <div class="uk-panel uk-panel-divider uk-text-center">
                <p class="js-avatar"></p>
                <div class="js-info">
                    @if (user.id)
                    <ul class="uk-list">
                        <li><span class="uk-badge uk-badge-@(user.status ? 'success' : 'danger')">@user.statusText</span></li>
                        <li>@user.name (@user.username)</li>
                        <li><a href="mailto:@user.email">@user.email</a></li>
                        <li>@trans('Last login: %date%', ['%date%' => user.login ? user.login|date : trans('Never')])</li>
                        <li>@trans('Registered since: %date%', ['%date%' => user.registered|date])</li>
                    </ul>
                    @endif
                </div>
            </div>

        </div>
        <div class="uk-width-medium-3-4">

            <div class="uk-form-row">
                <label for="form-username" class="uk-form-label">@trans('Username')</label>
                <div class="uk-form-controls">
                    <input id="form-username" class="uk-form-width-large" type="text" name="user[username]" value="@user.username" required>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-name" class="uk-form-label">@trans('Name')</label>
                <div class="uk-form-controls">
                    <input id="form-name" class="uk-form-width-large" type="text" name="user[name]" value="@user.name" required>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-email" class="uk-form-label">@trans('Email')</label>
                <div class="uk-form-controls">
                    <input id="form-email" class="uk-form-width-large" type="email" name="user[email]" value="@user.email" required>
                </div>
            </div>

            <div class="uk-form-row">
                <label for="form-password" class="uk-form-label">@trans('Password')</label>

                @if (user.id)
                <div class="uk-form-controls uk-form-controls-text js-password">
                    <a href="#" data-uk-toggle="{ target: '.js-password' }">@trans('Change password')</a>
                </div>
                @endif

                <div class="uk-form-controls@(user.id ? ' js-password uk-hidden')">
                    <div class="uk-form-password">
                        <input id="form-password" class="uk-form-width-large" type="password" name="password" value="">
                        <a href="" class="uk-form-password-toggle" data-uk-form-password>@trans('Show')</a>
                    </div>
                </div>

            </div>

            <div class="uk-form-row">
                <span class="uk-form-label">@trans('Status')</span>
                <div class="uk-form-controls uk-form-controls-text">
                    @foreach (user.statuses as status => name)
                    <p class="uk-form-controls-condensed">
                        <label><input type="radio" name="user[status]" value="@status"@(user.status == status ? ' checked')@(app.user.id == user.id ? ' disabled')> @name</label>
                    </p>
                    @endforeach
                </div>
            </div>

            @if (roles)
            <div class="uk-form-row">
                <span class="uk-form-label">@trans('Roles')</span>
                <div class="uk-form-controls uk-form-controls-text">
                    @foreach (roles as role)
                    <p class="uk-form-controls-condensed">
                        <label><input type="checkbox" name="@(!role.isAuthenticated ? 'roles[]')" value="@role.id" @(user.hasRole(role) ? 'checked')@(role.disabled ? ' disabled')> @role.name</label>
                    </p>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

    <input type="hidden" name="id" value="@(user.id ?: 0)">

    @token()

</form>

<script type="text/tmpl" data-tmpl="user.info">

    <ul class="uk-list">
        <li><span class="uk-badge uk-badge-{{badge}}">{{status}}</span></li>
        <li>{{name}} ({{username}})</li>
        <li><a href="mailto:{{email}}">{{email}}</a></li>
        <li>@trans('Last login: {{login}}')</li>
        <li>@trans('Registered since: {{registered}}')</li>
    </ul>

</script>