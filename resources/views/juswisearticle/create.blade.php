@extends('layouts.app')

@section("title") Create Article @endsection
<style>
    .areabutton{
        background:#5f004f;
        color:#fff;
        margin:3px 5px;
        padding:10px;
        border-radius:3px;
    }
    div.isHide{
        display:none;
    }
    div.selectorcontainer{
        height:170px;
    }
    
</style>
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Tiny Script -->
<script src="https://cdn.tiny.cloud/1/ekzc7ui2dcqdle2pclgtww95j8g14pwocjd2ou489c4zrr2n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container-fluid">
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article Lists</a></li>
        <li class="breadcrumb-item active mb-3" aria-current="page">Create Article
    </x-bread-crumb>
<form  method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
@csrf      
    <!-- Areas and Categories -->
    <div class="row mt-3 mb-3">
        <!-- Categories -->
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body selectorcontainer">
                    <h6 class="fw-bold">Select Category</h6>
                    <Select class="form-select @error('categoryidcarrier')
                            is-invalid
                            @enderror" id="categoryidselector" name="categoryidselector" required>
                                <option value="" disabled>
                                    Select Category
                                </option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id }}">{{ $category->title }}</option>
                                @endforeach
                    </Select>
                    @error('categoryidcarrier')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Area -->
        <div class="col-lg-9 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body selectorcontainer">
                    <h6 class="fw-bold">Select Area</h6>

                    <Select class="form-select @error('areaidcarrier')
                            is-invalid
                            @enderror" name="areaidselector" id="areaidselector" required>
                                <option value="" disabled>
                                    Select Area
                                </option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id.'-'.$area->title }}" id="{{$area->title}}">{{ $area->title }}</option>
                                @endforeach
                            
                    </Select>
                    @error('areaidcarrier')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="container @error('areaidcarrier')
                            isHide
                            @enderror" id="areaanchorscontainers">
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Areas and Categoreis -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mt-3">
                <div class="card-body case-card m-4">
                    <!-- Create Article -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-0">
                                        <i class="feather-plus-circle"></i>
                                        Create Article
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <textarea style="display:none" id="areanamecarrier" name="areanamecarrier">
                    </textarea>

                    <textarea style="display:none" id="areaidcarrier" name="areaidcarrier"> 
                    </textarea>
                    
                    <!-- Article Title -->
                    <div class="form-group mb-4">
                        <label for="title">Article Title</label>
                        <input type="text" id="title" class="form-control fs-5 @error('title')
                            is-invalid
                        @enderror" placeholder="" value="{{ old('title') }}" name="title" required>
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- Questions for student readers -->
                    <div class="form-group mb-4">
                        <label for="questionforstudentreader">Questions for student readers</label>
                        <input type="text" id="questionforstudentreader" class="form-control fs-5 @error('questionforstudentreader')
                            is-invalid
                        @enderror" placeholder="" value="{{ old('questionforstudentreader') }}" name="questionforstudentreader" required>
                        @error('questionforstudentreader')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label>Body</label>
                        <textarea name="articlebody" rows="10" cols="40" class="form-control tinymce-editor
                        @error('articlebody')
                        is-invalid
                        @enderror" >{{ old('articlebody')}}</textarea>
                        @error('articlebody')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>  
                    
                    <button class="btn btn-primary btn-lg w-100 mt-3">Update Case</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Tiny Script -->
<script src="https://cdn.tiny.cloud/1/ekzc7ui2dcqdle2pclgtww95j8g14pwocjd2ou489c4zrr2n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>
<script>
                                                
    // console.log('testing');
    const areaids = [];
    const areaidselector = document.getElementById('areaidselector');

    const areaanchorscontainers = document.getElementById('areaanchorscontainers');
    const areaidcarrier = document.getElementById('areaidcarrier');
    const areanamecarrier = document.getElementById('areanamecarrier');


    // console.log(areaidcarrier.value);
    // console.log(categoryidcarrier);
    // console.log(categoryidselector);
    // console.log(areaid);
    // console.log(areaanchorscontainers);

    if(areaidcarrier.value!== null && !areaanchorscontainers.classList.contains('isHide'))    
    {
        let areas = areaidcarrier.value.split(`"-"`);
        let area_name = areanamecarrier.value.split(`"-"`);


        for(let i = 0;i<areas.length-1;i++)
        {
            areaids[i] = parseInt(areas[i]);

            let areaanchor = document.createElement('button');
            areaanchor.setAttribute('value',`${areaids[i]}`);
            areaanchor.innerHTML = `${area_name[i]}`;
            areaanchor.setAttribute('class',"areabutton");

            // console.log(areaanchor);
        
            areaanchorscontainers.appendChild(areaanchor);
            areaanchorscontainers.style.marginTop = "12px";
            assignAreaValue();
            // console.log(areaidcarrier.value);
            

            areaanchor.addEventListener('click',(e)=>{
                // console.log('click');
                let value = e.target.value;
                console.log("Value"+value);
                areaanchorscontainers.removeChild(areaanchor);
                console.log(areaids);

                let myIndex = -1;
                for(let j = 0; j<areaids.length;j++)
                {
                    if(value == areaids[j]){
                        myIndex = j;
                    }
                }
                console.log("myindex"+myIndex);
                if(myIndex != -1){
                    areaids.splice(myIndex, 1);
                    // console.log("areaids"+areaids);
                    assignAreaValue();
                }
                
            })
        }
    }
    
    
                                    
    areaidselector.addEventListener('change',(e)=>{
        let selected = e.target.value.split('-');
        let selectedIndex = selected[0];
        let selectedValue = selected[selected.length-1];

        // console.log(selected);
        areaanchorscontainers.classList.remove('isHide');

        if(areaids.length <3){
            console.log('selected index' + selectedIndex);
            let block = false;
            for(let j = 0; j<areaids.length;j++)
            {
                if(areaids[j] == parseInt(selectedIndex)){
                    block = true;
                }
            }

            if(!block){
            areaids.push(selectedIndex);

            let areaanchor = document.createElement('button');
            areaanchor.setAttribute('value',`${selectedIndex}`);
            areaanchor.innerHTML = `${selectedValue}`;
            areaanchor.setAttribute('class',"areabutton");

            // console.log(areaanchor);
        
            areaanchorscontainers.appendChild(areaanchor);
            areaanchorscontainers.style.marginTop = "12px";
            assignAreaValue(null);
            // console.log(areaidcarrier.value);
            

            areaanchor.addEventListener('click',(e)=>{
                // console.log('click');
                let value = e.target.value;
                console.log("Value"+value);
                areaanchorscontainers.removeChild(areaanchor);
                //   areaids.pop(value);
                
                let myIndex = areaids.indexOf(value);
                // console.log("myindex"+myIndex);
                if(myIndex != -1){
                    areaids.splice(myIndex, 1);
                    // console.log("areaids"+areaids);
                    assignAreaValue();
                }
            })

        }  
        }
    })

    function assignAreaValue(){
        console.log(areaidcarrier);
        areaidcarrier.value = "";
        for(let i=0;i<areaids.length;i++){
            if(i == 0){
                areaidcarrier.value = areaids[0];
            }
            else{
                areaidcarrier.value = areaidcarrier.value+","+areaids[i];
            }                 
        }
    }    
</script>
@endsection
