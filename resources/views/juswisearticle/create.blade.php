@extends('layouts.app')

@section("title") Create Article @endsection

@section('content')
<div class="container-fluid">
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article Lists</a></li>
        <li class="breadcrumb-item active mb-3" aria-current="page">Create Article
    </x-bread-crumb>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mt-3">
                <div class="card-body case-card m-4">
                    <form action="{{ route('article.store') }}" method="POST">
                        @csrf
                        <!-- Categories -->
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

                        <!-- Categories -->
                        <div class="row mt-3 mb-3">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body" style="height: 150px;">
                                        <h6 class="fw-bold">Select Category</h6>
                                        <Select class="form-select @error('category_id')
                                                is-invalid
                                                @enderror" name="category_id" required>
                                                    <option value="" disabled>
                                                        Select Category
                                                    </option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
                                                        '' }}>{{ $category->title }}</option>
                                                    @endforeach
                                        </Select>
                                        @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Area -->
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body" style="height: 150px;">
                                        <h6 class="fw-bold">Select Area</h6>
                                        <Select class="form-select @error('areaid')
                                                is-invalid
                                                @enderror" name="areaid" id="areaid" required>
                                                    <option value="" disabled>
                                                        Select Area
                                                    </option>
                                                    @foreach ($areas as $area)
                                                    <option value="{{ $area->id.'-'.$area->title }}" id="{{$area->title}}" {{ old('areaid')==$area->id ? 'selected' :
                                                        '' }}>{{ $area->title }}</option>
                                                    @endforeach
                                        </Select>
                                        @error('areaid')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="container" id="areaanchorscontainers">
                                            <textarea style="display:none" id="areaidcarrier" name="areaidcarrier"></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Article Title -->
                        <div class="form-group mb-4">
                            <label for="articletitles">Article Title</label>
                            <input type="text" id="articletitles" class="form-control fs-5 @error('title')
                                is-invalid
                            @enderror" placeholder="" value="{{ old('title') }}" name="title" required>
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Text Editor -->
                        <!-- <div class="form-group mb-4">
                            <label>Body</label>
                            <textarea rows="10" class="form-control fs-5 @error('case_number')
                                is-invalid
                            @enderror" placeholder="" name="mytext_area" id="mytext_area"
                                required>{{ old('case_number') }}</textarea>
                            @error('case_number')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> -->
                        

                        <!-- Source Citation -->
                        <!-- <div class="form-group mb-4">
                            <label for="soursecitations">Source/Ciation</label>
                            <input type="text" id="soursecitations" class="form-control fs-5 @error('sourceciations')
                                is-invalid
                            @enderror" placeholder="" value="{{ old('sourcecitations') }}" name="sourcecitations" required>
                            @error('sourcecitations')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> -->
                       
                        <!-- Questions for student readers -->
                        <div class="form-group mb-4">
                            <label for="questionsforstudentreaders">Questions for student readers</label>
                            <input type="text" id="questionsforstudentreaders" class="form-control fs-5 @error('questionsforstudentreaders')
                                is-invalid
                            @enderror" placeholder="" value="{{ old('questionsforstudentreaders') }}" name="questionsforstudentreaders" required>
                            @error('questionsforstudentreaders')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary btn-lg w-100 mt-3">Create Case</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tiny Script -->
<script src="https://cdn.tiny.cloud/1/ekzc7ui2dcqdle2pclgtww95j8g14pwocjd2ou489c4zrr2n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector:'#mytext_area'
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
                                                
        // console.log('testing');
        const areaids = [];
        const areaid = document.getElementById('areaid');
        const areaanchorscontainers = document.getElementById('areaanchorscontainers');
        const areaidcarrier = document.getElementById('areaidcarrier');
        console.log(areaidcarrier);
        // console.log(areaid);
        // console.log(areaanchorscontainers);
        
                                        
        areaid.addEventListener('change',(e)=>{
            let selected = e.target.value.split('-');
            let selectedIndex = selected[0];
            let selectedValue = selected[1];

            console.log(selected);

            if(areaids.length <3){
                if(!areaids.includes(selectedIndex)){
                // console.log('Push');
                areaids.push(selectedIndex);

                let areaanchor = document.createElement('button');
                areaanchor.setAttribute('value',`${selectedIndex}`);
                areaanchor.innerHTML = `${selectedValue}`;
                areaanchor.style.color ="white";
                areaanchor.style.background = "#5f004f";
                areaanchor.style.marginRight = "5px"
                areaanchor.style.padding = "10px"
                areaanchor.style.borderRadius = "3px"

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
            areaidcarrier.value = "";
            for(let i=0;i<areaids.length;i++){
                if(i == 0){
                    areaidcarrier.value = areaids[0];
                }
                else{
                    areaidcarrier.value = areaidcarrier.value+","+areaids[i];
                }                 
            }
            console.log(areaidcarrier.value);
        }    
</script>
@endsection
