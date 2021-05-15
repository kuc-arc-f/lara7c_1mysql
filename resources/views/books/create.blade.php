
@extends('layouts.app_layout')
@section('title', '新規作成')

@section('content')
<div id="app"></div>
<!-- -->
<script type="text/babel" src="/js/LibBook.js?a1" ></script>
<script type="text/babel">
class Page extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      title: '', content: '', radio_1: 0,
      check_items: [], radio_items: [],
    }
  }
  async componentDidMount(){
    var res = await axios.get("/api/category/list")
    var resTags = await axios.get("/api/tags/list")
//    var items= LibBook.get_check_items();
    var items= resTags.data
    var radio_items= res.data;
    this.setState({
      check_items: items, radio_items:radio_items
    })
//console.log(resTags.data )
  }
  handleChangeTitle(e){
    this.setState({title: e.target.value})
  }
  handleChangeContent(e){
    this.setState({content: e.target.value})
  }
  handleClick(){
console.log("#-handleClick")
    this.add_item()
  }
  handleChangeRadio(e){
    const target = e.target;
    const value = target.value;
    const name = target.name;
console.log(name, value)
    var elemRadio = document.getElementById('hidden_radio_1');
    elemRadio.value = value
    this.setState({radio_1: e.target.value})
  }  
  async add_item(){
    try {
      var myForm = document.getElementById('myForm');
      var formData = new FormData(myForm); 
      var elem = [] 
      var check_items = this.state.check_items  
      check_items.map((item, index) => {
//console.log(item.name)
        var elemName = "check_" + item.id
        var value = formData.get( elemName )
        if(value ==  "on"){
          console.log(item.name, value)
          elem.push(item.id)
        }
      }) 
      var json= JSON.stringify( elem );         
      var elemType = document.getElementById('type_1');
      var elemRadio = document.getElementById('hidden_radio_1');
      var elemDate = document.getElementById('date_1');
      var item = {
        title: this.state.title,
        content: this.state.content,
        type: elemType.value,
        radio_1: elemRadio.value,
        check_1: json,
        date_1: elemDate.value,
      }
      const res = await axios.post(
        '/api/books/create', item 
      )
      window.location.href="/books"
      /*
      */
console.log(item)
    } catch (error) {
      alert("Error, save item")
      console.error(error);
    }
  }  

  checkRow(){
    var check_items = this.state.check_items
    return check_items.map((item, index) => {
// console.log(item )
      var name = "check_" + item.id
      return(
        <label key={index} className="">
          <input type="checkbox" name={name} id={name}
          />
          <span className="mr-2">{item.name}</span>
        </label>           
      )
    })    
  }   
  render() {
    var radio_items = this.state.radio_items
    return (
    <div className="container">
      <a href="/books" className="btn btn-outline-primary mt-2">Back</a>
      <hr className="mt-2 mb-2" />
      <h1 className="mt-2">Create - Book</h1>
      <form action="/" method="post" id="myForm" name="myForm">
      
      <div className="row">
        <div className="col-md-6 form-group">
          <label>Title:</label>
          <input type="text" className="form-control"
          onChange={this.handleChangeTitle.bind(this)}/>
        </div>
      </div>
      <div className="row">
        <div className="col-md-6 form-group">
          <label>Content:</label>
          <textarea type="text" name="content" className="form-control" rows="3"
            onChange={this.handleChangeContent.bind(this)} ></textarea>          
        </div>
      </div>
      <div className="row">
        <div className="col-md-6 form-group">
          <label>bookType:</label>
          <select className="form-control" name="type_1" id="type_1">
            <option value="0">select please</option>
            <option value="1">option-1</option>
            <option value="2">option-2</option>
            <option value="3">option-3</option>
          </select>
        </div>
      </div>      
      <hr className="my-2" /> 
      <div className="row">
        <div className="col-md-6 form-group">
          <label>Radio:</label><br />
          <input type="hidden" name="hidden_radio_1" id="hidden_radio_1" 
          value={this.state.radio_1}
          />
          {radio_items.map((item, index) => {
            var checkedOn = false;
            if(index==0){ checkedOn = true;}
//    console.log(index , checkedOn )
            return(
              <span key={index}>
                <input type="radio" name="radio_1" id="radio_1" value={item.id}
                defaultChecked={checkedOn} onChange={this.handleChangeRadio.bind(this)} />
                 {item.name}<br />         
              </span>
            )
          })}         
        </div>
      </div>      
      <hr className="my-2" />
      <div className="row">
        <div className="col-md-6 form-group">
          <label>CheckBox:</label><br />
          {this.checkRow()}
        </div>
      </div>
      <hr className="my-2" />
      <div className="col-sm-6 form-group">
        <label>Date:</label>
        <input type="date" name="date_1" id="date_1" className="form-control" 
         />
      </div>
      </form>
      <br />
      <div className="form-group">
        <button className="btn btn-primary" onClick={this.handleClick.bind(this)}>
          Create</button>
      </div>
    
    </div>
    )
  }  

}
ReactDOM.render(<Page />, document.getElementById('app'));
</script>
@endsection
