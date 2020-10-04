<form action="{{route('login.post')}}" method="post" class="form-horizontal">
    {{ csrf_field() }}

    <fieldset>
        <label class="block clearfix">
            <span class="block input-icon input-icon-right @error('username') has-error @enderror">
                <input type="text"
                        name="username"
                        class="form-control "
                        placeholder="Username / Email"
                        value="{{old("username")}}"
                         />
                <i class="ace-icon fa fa-user"></i>
                @error('username')
                    <span class="help-block inline" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            </span>
        </label>

        <label class="block clearfix">
            <span class="block input-icon input-icon-right @error('password') has-error @enderror">
                <input type="password"
                        name="password"
                       class="form-control"
                       placeholder="Password"
                       value="{{old("password")}}"/>
                <i class="ace-icon fa fa-lock"></i>
                @error('password')
                    <span class="help-block inline" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </label>

        <div class="space"></div>

        <div class="clearfix">
            <label class="inline">
                <input type="checkbox" class="ace" />
                <span class="lbl"> Remember Me</span>
            </label>

            <input type="submit"
                    value="Log in"
                    class="width-35 pull-right btn btn-sm btn-primary"/>
        </div>

        <div class="space-4"></div>
    </fieldset>
</form>
