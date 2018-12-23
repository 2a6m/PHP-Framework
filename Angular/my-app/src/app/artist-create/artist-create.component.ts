import { Component, OnInit } from '@angular/core';
import { Artist } from 'src/app/artist';
import { ArtistsService } from 'src/app/artists.service';
import { Router } from '@angular/router';

import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-artist-create',
  templateUrl: './artist-create.component.html',
  styleUrls: ['./artist-create.component.css']
})
export class ArtistCreateComponent implements OnInit {
    newArtist: Artist;

    constructor(private router: Router, private artistsservice: ArtistsService) {
        this.newArtist= new Artist();
    }

    ngOnInit() {
    }

    onSubmit() {
        console.log(this.newArtist)
        this.artistsservice.createArtist(this.newArtist).subscribe((data) => {
            console.log(data)
            if(data.status == true) {
                this.router.navigate(['/artists']);
            }
        })
    }
}
