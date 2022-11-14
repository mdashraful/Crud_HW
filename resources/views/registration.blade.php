@extends('template')

@section('content')
    <div class="form">
        <h2>Student Registration</h2>
        
        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Student Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
            @error('name')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label>Birthday:</label>
            <input type="date" name="b_date" class="@error('b_date') is-invalid @enderror" placeholder="dd-mm-yyyy" min="1990-01-01" max="{{ date('Y-m-d') }}" value="{{ old('b_date') }}">
            @error('b_date')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <p>Gender:</p>
            <input type="radio" name="gender" id="male" class="" value="male" {{ old('gender') == 'male'?'checked':'' }}>
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" class="" value="female" @php echo old('gender') == 'female'?'checked':'' @endphp>
            <label for="female">Female</label><br>
            @error('gender')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label style="margin-top: 10px; display: inline-block;">Address:</label><br>
            <textarea rows="4" cols="25" name="address" class="@error('address') is-invalid @enderror">{{ old('address') }}</textarea>
            @error('address')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror
    
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
            @error('email')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label>Phone:</label>
            <span>(+88)</span>
            <input type="tel" name="phone" pattern="[0-9]{11}}" placeholder="" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
            @error('phone')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <p>Interests:</p>
            <input type="checkbox" name="interest[]" id="" value="frontend" @if(is_array(old('interest')) && in_array('frontend', old('interest'))) checked @endif>
            <label>Front-end</label>
            <input type="checkbox" name="interest[]" id="" value="backend" @php echo (is_array(old('interest')) && in_array('backend', old('interest')))?'checked':''; @endphp>
            <label>Back-end</label>
            <input type="checkbox" name="interest[]" id="" value="both" @if(is_array(old('interest')) && in_array('both', old('interest'))) checked @endif>
            <label>Both</label>
            <br/><br/>

            <div style="display:inline-block; float:left; width:50%; padding-right:15px;">
                <label>Batch:</label>
                <select name="batch" style="margin-right: 50px" class="@error('batch') is-invalid @enderror">
                    <option value="" selected hidden disabled>Choose a batch</option>
                    <option value="evening" {{ old('batch')=='evening'?'selected':'' }}>Evening</option>
                    <option value="morning" {{ old('batch')=='morning'?'selected':'' }}>Morning</option>
                    <option value="night" {{ old('batch')=='night'?'selected':'' }}>Night</option>
                </select>
                @error('batch')
                    <div class="alert_danger">* {{ $message }}</div>
                @enderror
            </div>
            <div style="display:inline-block; width:50%; padding-left: 15px;">
                <label>Courses:</label>
                <select name="course[]" size="3" multiple class="" style="" >
                    <!-- <option value="" disabled >Choose courses</option> -->
                    <option value="html" @if(is_array(old('course')) && in_array('html', old('course'))) selected @endif>HTML</option>
                    <option value="css" @if(is_array(old('course')) && in_array('css', old('course'))) selected @endif>CSS</option>
                    <option value="javascript" @if(is_array(old('course')) && in_array('javascript', old('course'))) selected @endif>JAVASCRIPT</option>
                    <option value="php" @if(is_array(old('course')) && in_array('php', old('course'))) selected @endif>PHP</option>
                    <option value="laravel" @if(is_array(old('course')) && in_array('laravel', old('course'))) selected @endif>LARAVEL</option>
                </select>
                @error('course')
                    <div class="alert_danger">* {{ $message }}</div>
                @enderror
            </div>
            <p>Hours you may give for practice per day: </p>
            <input type="number" name="p_hour" value="{{ old('p_hour') }}" class="@error('p_hour') is-invalid @enderror">
            @error('p_hour')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror
            <div style="margin-top: 20px;">
                <div style="display:inline-block; width:50%; float:left;">
                    <label for="">Image:</label>
                    <input type="file" name="image" accept="image/*">
                    @error('image')
                        <div class="alert_danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div style="display:inline-block; width:50%; padding-left:15px;">
                    <label for="" style="">CV:</label>
                    <input type="file" name="cv" accept=".pdf">
                    @error('cv')
                        <div class="alert_danger">* {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn" style="margin-top:20px;">Submit</button>
        </form>
    </div>
@endsection