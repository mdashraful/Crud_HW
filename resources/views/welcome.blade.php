@extends('template')

@section('content')
    <div class="table">
        @if(session()->has('success'))
            <div class="success-msg">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
        <div class="delete-msg">
                {{ session()->get('error') }}
            </div>
        @endif
        <h2>Students Table</h2>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Interests</th>
                    <th>Courses</th>
                    <th>Batch</th>
                    <th>Image</th>
                    <th>CV</th>
                    <th>Action</th>
                </tr>
                @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->b_date }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        @forelse($student->interest as $interest)
                            @if ($loop->last)
                                {{ $interest }}
                            @else
                                {{ $interest }},
                            @endif  
                        @empty
                            not given    
                        @endforelse
                    </td><td>
                        @foreach($student->course as $course)
                            @if ($loop->last)
                                {{ $course }}
                            @else
                                {{ $course }},
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $student->batch }}</td>
                    <td><img src="{{ ($student->image)?asset('upload/images/'. $student->image):asset('upload/images/test.jpg') }}" style="height: 80px; width: 100px;"></td>
                    <td><a href="{{ asset('upload/cvs/'. $student->cv) }}">Download</a></td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn_sm_gr">Update</a>
                        <!-- <a href="{{ route('student.destroy', $student->id) }}" class="btn_sm_rd">Delete</a> -->
                        <form action= "{{ route('student.destroy', $student->id) }}" method="POST" class="delete-form">
                            @csrf    
                            @method('delete')
                            <button class="btn_sm_rd delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                    No data
                @endforelse
            </table>
        
    </div>
@endsection

@section('script')
    <script>
        ;(function($){
            $(document).ready(function(){
              $(".delete").click(function(){
                if(confirm('Are you sure to delete?')) {
                    $(".delete-form").submit();
                }else{
                    return false;
                }
              });
            });
        })(jQuery);
    </script>
@endsection