@extends('.layout')
@section('title')
    عرض المرضى المخدمين
@endsection
@section('componemt')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="mb-3">قائمة بجميع المرضى</h2>
                    <p>يمكنك الاطلاع على المرضى الخاصين بك ويمكنك التعديل عليهم او ارسالهم لطبيب اخر وفي حال العمل مريض ما يمكنك وضع شرح مفصل لحالة المريض</p>
                </div>
            </div>
        </div>
    </section>

    <form method="HEAD" action="{{route('preview.index')}}" >
        @csrf
        <div class="mt-4">
            <h4 style="text-align: center">اختر المرض </h4>
            <select name="filter" class="form-select " aria-label="Default select example">
                <option selected value=0 >عرض الكل</option>
                @foreach($illnesses as $disease )
                    <option value="{{$disease->id}}">
                        {{$disease->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center justify-end mt-4">
            <input class="btn btn-primary" type="submit" value="submit" >
        </div>

    </form>

    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">fall name</th>
            <th scope="col">age</th>
            <th scope="col">illness</th>
            <th scope="col">doctor</th>
            <th scope="col">phone</th>
{{--            <th scope="col">control</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($previews as $preview)
            @if($preview->sick->user_id===auth()->user()->id)
                <tr>
                    <th scope="row">{{$preview->id}}</th>
                    <td ><h5>{{$preview->sick->full_name}}</h5></td>
                    <td>{{$preview->sick->age}}</td>
                    <td>{{$preview->sick->illness->name}}</td>
                    <td>{{$preview->sick->user->name}}</td>
                    <td>{{$preview->sick->phone_number}}</td>
                    <td>
                        <a class="btn btn-primary stretched-link" href="{{url('preview.edit',$preview->sick->id)}}">Add</a>
                        <a class="btn btn-primary stretched-link" href="{{route('sick.show',$preview->sick->id)}}">show</a>
                        <a class="btn btn-primary stretched-link" href="{{route('sick.edit',$preview->sick->id)}}">edit</a>
                        <a class=" btn btn-primary stretched-link">
                            <form action="{{route('sick.destroy',$preview->sick->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input style="background-color: #2f89fc ;color: white; border: none" class=" " type="submit" value="delete">
                            </form>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection
