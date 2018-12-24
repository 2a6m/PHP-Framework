import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ArtistsComponent } from './artists/artists.component';
import { MusicsComponent } from './musics/musics.component';
import { ArtistCreateComponent } from './artist-create/artist-create.component';
import { MusicCreateComponent } from './music-create/music-create.component';


const routes: Routes = [
    { path: 'artists', component: ArtistsComponent },
    { path: 'musics', component: MusicsComponent },
    { path: 'artist/create', component: ArtistCreateComponent},
    { path: 'music/create', component: MusicCreateComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
