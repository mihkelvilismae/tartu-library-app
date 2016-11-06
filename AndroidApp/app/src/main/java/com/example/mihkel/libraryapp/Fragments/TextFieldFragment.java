package com.example.mihkel.libraryapp.Fragments;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.mihkel.libraryapp.R;


/**
 * A placeholder fragment containing a simple view.
 */
public class TextFieldFragment extends Fragment {

    public TextFieldFragment() {
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        return inflater.inflate(R.layout.field_text, container, false);
    }
}
