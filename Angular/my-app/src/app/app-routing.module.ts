import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ArtistComponent } from './artist/artist.component';
import { MusicComponent } from './music/music.component';

const routes: Routes = [
    { path: 'artists', component: ArtistComponent },
    { path: 'musics', component: MusicComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
