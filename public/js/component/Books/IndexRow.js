class IndexRow extends React.Component {
  componentDidMount(){
//        console.log(this.props.obj)
  }
  render(){
console.log( this.props.obj.date )
/*
<a href={"/books/"+ this.props.obj.id}>{this.props.obj.title}
</a>
*/
    return (
    <tr>
      <td>
        {this.props.obj.id}
      </td>
      <td>
        <h3>{this.props.obj.title}</h3>
        <a href={"/books/"+ this.props.obj.id +"/edit"} > [ edit ]
        </a><br />
        { this.props.obj.date }
      </td>
      <td>
      </td>
    </tr>
    )
  }
}

