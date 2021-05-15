@extends('layouts.app_layout')

@section('title', "")

@section('content')
<div id="app"></div>
<!-- -->
<script type="text/babel" src="/js/LibBook.js?a1" ></script>
<script type="text/babel">
var ID = {{$book_id}};

class Page extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      title: '', content: '' , radio_1: 0, check_1:'', date_1: '',
      check_items: [], radio_items: [],
    }
  }
  async componentDidMount(){
    var res = await axios.get("/api/category/list")
    var resTags = await axios.get("/api/tags/list")    
    var items= resTags.data
    var radio_items= res.data
    this.setState({
      check_items: items, radio_items:radio_items
    })    
    this.get_item(ID);
// console.log(resTags.data )
  }
  handleChangeTitle(e){
    this.setState({title: e.target.value})
  }
  handleChangeContent(e){
    this.setState({content: e.target.value})
  }
  handleChangeRadio(e){
    const target = e.target;
    const value = target.value;
    const name = target.name;
//console.log(name, value)
    var elemRadio = document.getElementById('hidden_radio_1');
    elemRadio.value = value
  }    
  handleClick(){
    console.log("#-handleClick")
    this.update_item(ID)
  }
  handleClickDelete(){
    console.log("#-handleClick")
    this.delete_item(ID)
  }
  async delete_item(id){
    try {
      var item = {
        id: id,
      }
      const res = await axios.post(
        '/api/books/delete', item 
      )
console.log( res.data )
      window.location.href="/books"
    } catch (error) {
      alert("Error, save item")
      console.error(error);
    }
  }   
  async update_item(id){
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
        id: id,
        title: this.state.title,
        content: this.state.content,
        type: elemType.value,
        radio_1: elemRadio.value,
        check_1: json,
        date_1: elemDate.value,
      }
console.log( item  )      
      const res = await axios.post(
        '/api/books/update', item 
      )
      window.location.href="/books"
//console.log( res.data  )
    } catch (error) {
      alert("Error, save item")
      console.error(error);
    }
  }   
  async get_item(id){
    try {
      const res = await axios.get('/api/books/show?id=' + id)
console.log( res.data )
      var data = res.data;
      var elemType = document.getElementById('type_1');
      elemType.value= data.type
      var elemDate = document.getElementById('date_1');
      elemDate.value =data.date_1

      this.setState({ 
        title: data.title, 
        content: data.content,
        radio_1: data.radio_1,
        check_1: data.check_1,
        date_1: data.date_1,
      });       
    } catch (error) {
      alert("Error, save item")
      console.error(error);
    }
  }  
  checkRow(){
    var check_1 = JSON.parse(this.state.check_1 || '[]')
    var check_items = this.state.check_items
    return check_items.map((item, index) => {
//console.log(check_1 )
      var name = "check_" + item.id
      var valid = LibBook.valid_check(parseInt(item.id), check_1)
//console.log(valid )
      return(
        <label key={index} className="">
          {valid==true ? <input type="checkbox" name={name} id={name} defaultChecked={true}/>
          : 
          <span><input type="checkbox" name={name} id={name}  />
          </span> 
          }
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
      <h1 className="mt-2">編集 - Book</h1>
      <form action="/" method="post" id="myForm" name="myForm">
      <div className="row">
        <div className="col-md-6">
          <div className="form-group">
            <label>Title:</label>
            <input type="text" className="form-control"
            value={this.state.title}
            onChange={this.handleChangeTitle.bind(this)}/>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-md-6">
          <div className="form-group">
            <label>Content:</label>
            <input type="text" className="form-control"
            value={this.state.content}
              onChange={this.handleChangeContent.bind(this)}/>
          </div>
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
          value={this.state.radio_1} />         
          {radio_items.map((item, index) => {
            var checkedOn = false;
            if(parseInt(this.state.radio_1) == parseInt(item.id)){ 
              checkedOn = true;
            }
//console.log(index , checkedOn )
            return(
              <span key={index}>
              {checkedOn ? 
                <input type="radio" name="radio_1" id="radio_1" value={item.id}
                defaultChecked={true} onChange={this.handleChangeRadio.bind(this)} />
              : <input type="radio" name="radio_1" id="radio_1" value={item.id}
                 onChange={this.handleChangeRadio.bind(this)} />
              }
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
      <div className="row">
        <div className="col-md-6 form-group">
          <label>Date:</label><br />
          <input type="date" name="date_1" id="date_1" className="form-control" 
          />          
        </div>
      </div>      
      <hr className="my-2" />

      </form>
      <div className="form-group">
        <button className="btn btn-primary"
          onClick={this.handleClick.bind(this)}>Save
        </button>
      </div>
      <div className="form-group ">
        <button className="btn btn-danger"
          onClick={this.handleClickDelete.bind(this)}>Delete
        </button>
      </div>
      <hr />
    
    </div>
    )
  }  

}
ReactDOM.render(<Page />, document.getElementById('app'));
</script>

@endsection
