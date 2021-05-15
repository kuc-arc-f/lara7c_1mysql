@extends('layouts.app_layout')
@section('title', 'タスク一覧')

@section('content')

<div class="container" style="margin-top: 16px;">
  <div id="app"></div>    
</div>
<!-- -->
<script type="text/babel" src="/js/component/Books/IndexRow.js?a1" ></script>
<script type="text/babel">
 var PAGE= {{$page}};

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
    axios.get("/api/books/list?page="+ page ).then(res =>  {
      var data = res.data
      var items = data.docs
console.log(data );
      this.setState({
        data: items, paginate_disp: data.page_item.paginate_disp
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
  dispPagenate(){
//console.log(this.state.paginate_disp)
    if(this.state.paginate_disp === 1){
      var url = "/books?page="
      return(
      <div className="paginate_wrap">
        <div className="btn-group" role="group" aria-label="Basic example">
          <a href={url+ 1} className="btn btn-outline-primary"> 1st  </a>
          <a href={url+ (PAGE+1)} className="btn btn-outline-primary"> > </a>
        </div>
      </div>
      )
    }
  }  
  render(){
    return (
    <div>
      <div className="row">
        <div className="col-sm-6"><h3>Books - index</h3>
        </div>
        <div className="col-sm-6">
          <a className="btn btn-primary" href="/books/create">New</a>
        </div>        
      </div>
      <table className="table table-hover">
        <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        {this.tabRow()}
        </tbody>
      </table> 
      {this.dispPagenate()}
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

