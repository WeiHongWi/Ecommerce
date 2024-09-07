<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border" style="margin-left: 5px;">
        <div class="card-body">
            <form method="POST" action="{{route('admin.general-setting.update')}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" value="{{$setting->site_name}}" class="form-control" name="site_name">
                </div>
                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" id="" class="form-control">
                        <option {{$setting->layout == 'LTR'?'selected':''}} value="LTR">LTR</option>
                        <option {{$setting->layout == 'RTL'?'selected':''}} value="RTL">RTL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="text" value="{{$setting->contact_email}}" class="form-control" name="contact_email">
                </div>
                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select name="currency" id="" class="form-control select2">
                        <option value="">Selected</option>
                        @foreach (config('setting.currency_list') as $currency => $val )
                            <option {{$setting->currency == $currency?'selected':''}} value="{{$currency}}">{{$currency}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Currency Icon</label>
                    <input type="text" value="{{$setting->currency_icon}}" class="form-control" name="currency_icon">
                </div>
                <div class="form-group">
                    <label>TimeZone</label>
                    <select name="timezone" id="" class="form-control select2">
                        <option value="">Selected</option>
                        @foreach (config('setting.time_zone') as $key =>$val)
                            <option {{$setting->timezone == $key?'selected':''}} value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>

    </div>
</div>
