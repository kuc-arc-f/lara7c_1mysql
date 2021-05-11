@extends('layouts.app_layout')
@section('title', '')

@section('content')

<div class="container" >
  <div class="row" style="margin-top: 16px;">
    <div class="col-sm-6"><h3>Tasks - index</h3>
    </div>
    <div class="col-sm-6" style="text-align: right;">
      <a class="btn btn-primary" href="/">New</a>
    </div>
  </div>
  <div id="app"></div>    
</div>
<!-- -->
<script type="text/babel" src="/js/component/Tasks/IndexRow.js?a1" ></script>
<script type="text/babel">
 var PAGE= 1;

class List extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      data: '', item_count:0, paginate_disp:0 
    }
  }
  componentDidMount(){
      this.get_items(PAGE);
  }
  get_items(page){
    axios.get("/api/apitasks/get_tasks?page="+ page ).then(res =>  {
      var data = res.data
      var arr =[];
console.log(data );
//console.log(paginate_disp );
      this.setState({
        data: data, paginate_disp: 0
      })
    })
  }    
  tabRow(){
    if(this.state.data instanceof Array){
      return this.state.data.map(function(object, index){
//console.log(object );
        return <IndexRow obj={object} key={index} />
      })
    }
  }
  render(){
    return (
    <div>
      <hr />
    </div>
    )
  }
}
ReactDOM.render(<List />, document.getElementById('app'));
</script>
<style>
.p_tbl_task_name{ font-size: 1.2rem; }
.task-table td{ padding : 8px;}
.task-table  td i {font-size : 1.2rem; }
</style>

@endsection

