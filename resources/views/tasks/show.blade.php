@extends('layouts.app_react')

@section('title', "" )

@section('content')
<div id="app"></div>
<!-- -->
<script type="text/babel">
var task_id= "{{$task_id}}";

class Show extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            title: '', 
            content: '' ,
        }
        this.id = props.id
console.log(this.id)
    }
    componentDidMount(){
        this.get_item( this.id )        
    }
    async get_item(id){
        var task = {
            id: id,
        };         
        axios.post('/api/apitasks/get_item' ,task).then(res =>  {
            var dat = res.data
console.log( dat )
            var item = dat
            this.setState({ 
                title: item.title,
                content: item.content,
            });            
        })        
    }    
    render(){
        return (
        <div>
            <h1>Show</h1>
            <hr />
            <h1>title : {this.state.title}</h1>
            <div>{this.state.content}</div>
        </div>
        )
    }
}
ReactDOM.render(<Show id={task_id}  />, document.getElementById('app'));
</script>

@endsection
