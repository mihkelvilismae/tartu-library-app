package com.example.mihkel.libraryapp.Activities;

/**
 * Created by mihkel on 6.12.2016.
 */
public interface AutoCompleteCallback {
    public void authorAutoCompleteCallback(String inputCharacters);
    public void genreAutoCompleteCallback(String inputCharacters);
    public void keywordAutoCompleteCallback(String inputCharacters);
}
