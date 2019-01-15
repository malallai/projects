/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 15:40:17 by malallai          #+#    #+#             */
/*   Updated: 2019/01/15 17:46:39 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static	short	is_a_word(char before, char current, char strip)
{
	return ((before == strip || before == 0) && current != strip);
}

static	int		total_words(char const *s, char strip)
{
	int i;
	int total;

	i = 0;
	total = 0;
	while (s[i])
	{
		if (is_a_word(s[i - 1], s[i], strip))
			total++;
		i++;
	}
	return (total);
}

static	int		word_len(const char *c, char strip)
{
	unsigned int	i;

	i = 0;
	while (c[i] && c[i] != strip)
		i++;
	return (i);
}

char			**ft_strsplit(char const *s, char c)
{
	char	**str;
	char	*tmp;
	int		i;
	int		stri;

	if (!s || !(str = (char**)malloc((total_words(s, c) + 1) * sizeof(char*))))
		return (NULL);
	tmp = (char*)s;
	i = 0;
	stri = 0;
	while (tmp[i])
	{
		if (is_a_word(i > 0 ? tmp[i - 1] : c, tmp[i], c))
		{
			if (!(str[stri] = ft_strndup(&tmp[i], word_len(&tmp[i], c))))
			{
				free(str);
				return (NULL);
			}
			stri++;
		}
		i++;
	}
	str[stri] = 0;
	return (str);
}
