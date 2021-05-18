@extends('layouts.app_layout')
@section('title', '')
@section('content')
<div class="container" style="margin-top: 16px;">
{{ csrf_field() }} 
  <div id="app"></div>
</div>
<script type="text/babel" src="/js/ImageTransfer.js?a2" ></script>
<script type="text/babel">
class Page extends React.Component {
  constructor(props) {
    super(props);
    this.state = {title: '', content: ''}
  }
  componentDidMount(){
    window.document.getElementById("attach_file").addEventListener("change", function() {
      console.log("#change");
      //ImageTransfer.upload('file1');
      ImageTransfer.upload('attach_file');
    });    
  }  
  handleChangeTitle(e){
    this.setState({title: e.target.value})
  }
  handleClick(){
console.log("#-handleClick")
/*
    var elem = document.getElementsByName('_token');
    let elemItem = elem.item(0);
console.log(elemItem.value)
*/
  }
  async add_item(){
    try {
      var item = {
        title: this.state.title,
        content: this.state.content,
      }
      const res = await axios.post(
        '/api/tasks/new', item 
      )
//console.log( res.data )
      window.location.href="/tasks"
    } catch (error) {
      alert("Error, save item")
      console.error(error);
    }
  }  
  render() {
    return (
    <div className="container">
      <a href="/tasks" className="btn btn-outline-primary mt-2">Back</a>
      <hr className="mt-2 mb-2" />
      <h3 className="mt-2">Create - Task</h3>
      <div className="row">
        <div className="col-md-6">
          <div className="form-group">
            <label>Title:</label>
            <input type="text" className="form-control"
            onChange={this.handleChangeTitle.bind(this)}/>
          </div>
        </div>
      </div>
      file : <br />
      <input type="file" name="attach_file" id="attach_file" /><br /><br />
      <div className="form-group">
        <button className="btn btn-primary"
          onClick={this.handleClick.bind(this)}>Create
        </button>
      </div>
    
    </div>
    )
  }  

}
ReactDOM.render(<Page />, document.getElementById('app'));
</script>

@endsection
