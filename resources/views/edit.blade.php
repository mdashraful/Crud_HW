@extends('template')

@php
    $studentInt = $student->interest;
    $studentCourse = $student->course;
@endphp
@section('content')
    <div class="form">
        <h2>Edit {{ $student->name }} Info.</h2>
        
        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Student Name:</label>
            <input type="text" name="name" value="{{ $student->name }}" class="@error('name') is-invalid @enderror">
            @error('name')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label>Birthday:</label>
            <input type="date" name="b_date" class="@error('b_date') is-invalid @enderror" min="1990-01-01" max="{{ date('Y-m-d') }}" value="{{ $student->b_date }}">
            @error('b_date')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <p>Gender:</p>
            <input type="radio" name="gender" id="male" class="" value="male" {{ $student->gender == 'male'?'checked':'' }}>
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" class="" value="female" @php echo $student->gender == 'female'?'checked':'' @endphp>
            <label for="female">Female</label><br>
            @error('gender')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label style="margin-top: 10px; display: inline-block;">Address:</label><br>
            <textarea rows="4" cols="25" name="address" class="@error('address') is-invalid @enderror">{{ $student->address }}</textarea>
            @error('address')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror
    
            <label>Email:</label>
            <input type="email" name="email" value="{{ $student->email }}" class="@error('email') is-invalid @enderror">
            @error('email')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <label>Phone:</label>
            <span>(+88)</span>
            <input type="tel" name="phone" pattern="[0-9]{11}}" value="{{ $student->phone }}" class="@error('phone') is-invalid @enderror">
            @error('phone')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror

            <p>Interests:</p>
            <input type="checkbox" name="interest[]" id="" value="frontend" @if(in_array('frontend', $studentInt)) checked @endif>
            <label>Front-end</label>
            <input type="checkbox" name="interest[]" id="" value="backend" @if(in_array('backend', $studentInt)) checked @endif>
            <label>Back-end</label>
            <input type="checkbox" name="interest[]" id="" value="both" @if(in_array('both', $studentInt)) checked @endif>
            <label>Both</label>
            <br/><br/>

            <div style="display:inline-block; float:left; width:50%; padding-right:15px;">
                <label>Batch:</label>
                <select name="batch" style="margin-right: 50px" class="@error('batch') is-invalid @enderror">
                    <option value="" selected hidden disabled>Choose a batch</option>
                    <option value="evening" {{ $student->batch == 'evening'?'selected':'' }}>Evening</option>
                    <option value="morning" {{ $student->batch == 'morning'?'selected':'' }}>Morning</option>
                    <option value="night" {{ $student->batch == 'night'?'selected':'' }}>Night</option>
                </select>
                @error('batch')
                    <div class="alert_danger">* {{ $message }}</div>
                @enderror
            </div>
            <div style="display:inline-block; width:50%; padding-left: 15px;">
                <label>Courses:</label>
                <select name="course[]" size="3" multiple="multiple" class="" style="" >
                    <!-- <option value="" disabled >Choose courses</option> -->
                    <option value="html" @if(in_array('html', $studentCourse)) selected @endif>HTML</option>
                    <option value="css" @if(in_array('css', $studentCourse)) selected @endif>CSS</option>
                    <option value="javascript" @if(in_array('javascript', $studentCourse)) selected @endif>JAVASCRIPT</option>
                    <option value="php" @if(in_array('php', $studentCourse)) selected @endif>PHP</option>
                    <option value="laravel" @if(in_array('laravel', $studentCourse)) selected @endif>LARAVEL</option>
                </select>
                @error('course')
                    <div class="alert_danger">* {{ $message }}</div>
                @enderror
            </div>
            <p>Hours you may give for practice per day: </p>
            <input type="number" name="p_hour" value="{{ $student->p_hour }}" class="@error('p_hour') is-invalid @enderror">
            @error('p_hour')
                <div class="alert_danger">* {{ $message }}</div>
            @enderror
            <div style="margin-top: 20px; overflow:hidden;">
                <div style=" display:inline-block; width:50%; float:left;">
                    @if($student->image)
                        <div>
                            <img src="{{asset('upload/images/'. $student->image)}}" alt="" width="120px" height="120px">
                        </div>
                        <label for="">Change Image:</label>
                        <input type="file" name="image" accept="image/*">
                    @else
                    <label for="">Image:</label>
                    <input type="file" name="image" accept="image/*">
                    @endif
                    @error('image')
                        <div class="alert_danger">* {{ $message }}</div>
                    @enderror
                </div>
                <div style="display:inline-block; width:50%; padding-left:15px;">
                    <a href="{{asset('upload/cvs/'.$student->cv)}}" target="">Download CV</a>
                    <br>
                    <label for="" style="">Update CV:</label>
                    <input type="file" name="cv" accept=".pdf">
                    @error('cv')
                        <div class="alert_danger">* {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn" style="margin-top:20px;">Update</button>
        </form>
    </div>
@endsection