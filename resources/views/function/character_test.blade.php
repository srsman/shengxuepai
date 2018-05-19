@extends('layout')
@section('title')
专业兴趣测评
@endsection
@section('navbar')
<li class="navbar-a-underline navbar-a-active"><a href="javascript:;">专业兴趣测评</a></li>
@endsection
@section('main')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <p class="bg-primary pad">“我的性格是怎样的？我的性格好吗？昨天想当老师，今天想当科学家，明天想当医生，究竟哪种职业才最适合我？又有哪些大学专业适合我？在茫茫大海的专业中我究竟该如何选择？……”</p>
        <p class="bg-primary pad">升学派“专业兴趣测评”系统主要运用了国际上最为认可的三大知名测评模型，分别是：霍兰德职业倾向测评模型、职业锚职业生涯测评模型、MBTI性格特质测评模型；并结合了中国目前大学学科、专业的设置，通过大数据分析，得出最适合测评者的个性化测评报告。</p>
        <p class="bg-primary pad">升学派衷心希望每一位测评者将来都能：“人适其职，职得其人；人尽其才，才尽其用”。</p>
        <p class="bg-primary pad">专业兴趣测评每人只能测试一次，请知悉！</p>
    </div>
    <div class="col-md-offset-5 col-md-2 text-center rt">
        <button class="btn btn-info btn-lg" data-toggle="modal">点击开始测试</button>
    </div>
</div>
@endsection
@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Character Test</h4>
                </div>
                <div class="modal-body">
                    <a id="link" target="_blank">您已做过专业兴趣测评，点击查看专业兴趣测评报告！</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    var  _token = "{{ csrf_token() }}";
    var URL = "{{ URL('/') }}";
</script>
<script src="{{ URL::asset('js/character.js') }}"></script>
@endsection