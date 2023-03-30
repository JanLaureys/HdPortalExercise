import React from 'react';
import { render } from 'react-dom';
import axios  from 'axios';

class DogBreeds extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      dogBreeds: [],
      pageSize: 5,
      links: {}
    };

    this.next = this.next.bind(this);
    this.previous = this.previous.bind(this);
  }

  loadData(url) {
    axios.get(url)
      .then(res => {
        const dogBreeds = res.data.data;
        const links = res.data.links;
        this.setState({ dogBreeds, links });
      })
  }

  // Load initial page.
  componentDidMount() {
    this.loadData(`/jsonapi/hd_entry/hd_entry?page[limit]=${this.state.pageSize}`);
  }

  // Load the previous page
  previous() {
    this.loadData(this.state.links.prev.href);
  }

  // Load the next page
  next() {
    this.loadData(this.state.links.next.href);
  }

  render() {
    // These classes are just some classes from Olivero, to give the table some default styling.
    return (
      <div className={"forum"}>
        <table className={"draggable-table"}>
          <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
          </tr>
          </thead>
          <tbody>
          {this.state.dogBreeds.map(breed => (
            <tr key={breed.id}>
              <td>{breed.attributes.drupal_internal__id}</td>
              <td>{breed.attributes.label}</td>
            </tr>
          ))}
          </tbody>
        </table>
        { this.state.links.prev && <button className={"button"} onClick={this.previous}>Previous</button> }
        { this.state.links.next && <button className={"button"} onClick={this.next}>Next</button>}
      </div>
    )
  }
}

const element = <DogBreeds/>;
render(element, document.getElementById('react-dogbreeds'));

