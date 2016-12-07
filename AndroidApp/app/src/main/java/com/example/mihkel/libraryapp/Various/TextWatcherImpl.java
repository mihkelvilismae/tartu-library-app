package com.example.mihkel.libraryapp.Various;

import android.text.Editable;
import android.text.TextWatcher;

import com.example.mihkel.libraryapp.Activities.AutoCompleteCallback;

/**
 * Created by mihkel on 6.12.2016.
 */
public class TextWatcherImpl implements TextWatcher {

    private AutoCompleteCallback autoCompleteCallback;

    public void setAutoCompleteCallback(AutoCompleteCallback autoCompleteCallback) {
        this.autoCompleteCallback = autoCompleteCallback;
    }

    @Override
    public void beforeTextChanged(CharSequence s, int start, int count, int after) {
        System.out.println("xxxxxx");
    }

    @Override
    public void onTextChanged(CharSequence s, int start, int before, int count) {
        System.out.println("onTextChanged");
        autoCompleteCallback.authorAutoCompleteCallback(String.valueOf(s));
    }

    @Override
    public void afterTextChanged(Editable s) {
//        System.out.println("xxxxxx");


    }
}
