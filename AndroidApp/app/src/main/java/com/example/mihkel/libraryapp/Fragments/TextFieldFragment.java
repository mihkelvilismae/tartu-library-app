package com.example.mihkel.libraryapp.Fragments;

import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.TextView;

import com.example.mihkel.libraryapp.R;


/**
 * A placeholder fragment containing a simple view.
 */
public class TextFieldFragment extends Fragment {

    TextView label;
    EditText editText;

    public TextFieldFragment() {
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

//        label = (TextView) container.findViewById(R.id.textView2);
//        label.setText("aaaaaaaaabbbbbbbbbbbbbaa");

        return inflater.inflate(R.layout._field_text, container, false);
    }
}
