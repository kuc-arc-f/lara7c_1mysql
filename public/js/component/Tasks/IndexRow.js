class IndexRow extends React.Component {
  componentDidMount(){
//        console.log(this.props.obj)
  }
  render(){
console.log( this.props.obj.date )
    return (
    <tr>
      <td>
        {this.props.obj.id}
      </td>
      <td>
        <a href={"/tasks/"+ this.props.obj.id}>{this.props.obj.title}
        </a>
        <a href={"/tasks/"+ this.props.obj.id +"/edit"} > [ edit ]
        </a><br />
        { this.props.obj.date }
      </td>
      <td>
      </td>
    </tr>
    )
  }
}

