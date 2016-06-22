@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->

    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 友情链接列表
    </div>
    <!--面包屑导航 结束-->

	{{--<!--结果页快捷搜索框 开始-->--}}
	{{--<div class="search_wrap">--}}
        {{--<form action="" method="post">--}}
            {{--<table class="search_tab">--}}
                {{--<tr>--}}
                    {{--<th width="120">选择分类:</th>--}}
                    {{--<td>--}}
                        {{--<select onchange="javascript:location.href=this.value;">--}}
                            {{--<option value="">全部</option>--}}
                            {{--<option value="http://www.baidu.com">百度</option>--}}
                            {{--<option value="http://www.sina.com">新浪</option>--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<th width="70">关键字:</th>--}}
                    {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                    {{--<td><input type="submit" name="sub" value="查询"></td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</form>--}}
    {{--</div>--}}
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">

        <div class="result_wrap">
            <div class="result_title">
                <h3>快捷操作</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>友情链接列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">链接排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>链接名称</th>
                        <th>链接标题</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $c)
                    <tr>
                        <td class="tc">
                            <input type="text"  onchange="changeOrder(this,{{$c->link_id}});" value="{{$c->link_order}}">
                        </td>
                        <td class="tc">{{$c->link_id}}</td>
                        <td>
                            <a href="#">{{$c->link_name}}</a>
                        </td>
                        <td>
                            <a href="#">{{$c->link_title}}</a>
                        </td>
                        <td><a href="">{{$c->link_url}}</a></td>
                        <td>
                            <a href="{{url('admin/links/'.$c->link_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delLinks({{$c->link_id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {!!$data->render()!!}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span {
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
    <script>
        function changeOrder(obj,link_id){
            var link_order = $(obj).val();
            $.post('{{url('admin/links/changeorder')}}',{'_token':'{{csrf_token()}}','link_order':link_order,'link_id':link_id},function(data){
                    if(data.status == 1){
                        layer.alert(data.msg, {icon: 6});
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        location.href = location.href;
                    }
            })

        }
        //delete the cate
        function delLinks(link_id){
            layer.confirm('您确定要删除这个链接吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url('admin/links/')}}/'+link_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                    if(data.status == 1){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5});
                    }
                });
//                layer.msg('的确很重要', {icon: 1});
            }, function(){
//                layer.msg('也可以这样', {
//                    time: 20000, //20s后自动关闭
//                    btn: ['明白了', '知道了']
//                });
            });
        }
    </script>



@endsection